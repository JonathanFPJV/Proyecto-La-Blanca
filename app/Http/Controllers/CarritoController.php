<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pedido;
use App\Models\Compra;
use App\Models\Logistica;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Almacen;

class CarritoController extends Controller
{
    public function index()
    {
        // Obtener los datos de compras, logistica y productos
        $compras = Compra::where('Estado', 'NP')
            ->with(['logistica' => function($query) {
                $query->with('producto');
            }])
            ->get();

        return view('carrito.index', compact('compras'));
    }

    public function addCarrito(Request $request)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'id_producto' => 'required|exists:productos,Id_Producto',
            'quantity' => 'required|integer|min:1',
        ]);

        // Obtener el usuario autenticado
        $usuario = Auth::user();

        // Generar el número de orden
        $n_orden = 'ORD' . $usuario->id . Carbon::now()->format('YmdHis');

        // Obtener el producto y verificar stock en los almacenes
        $idProducto = $request->input('id_producto');
        $quantity = $request->input('quantity');

        // Obtener el registro de logistica con mayor stock del producto
        $logistica = Logistica::where('Id_Producto', $idProducto)
                              ->orderBy('stock', 'desc')
                              ->first();

        if (!$logistica || $logistica->stock < $quantity) {
            return redirect()->back()->with('error', 'No hay suficiente stock disponible en los almacenes.');
        }

        // Obtener el almacén correspondiente
        $almacen = Almacen::find($logistica->Id_Almacen);

        // Crear el registro en la tabla logistica
        Logistica::create([
            'Id_usuario' => $usuario->id,
            'Id_Producto' => $idProducto,
            'n_orden' => $n_orden,
            'Cantidad' => $quantity,
            'Id_Almacen' => $almacen->Id_Almacen,
        ]);

        // Actualizar el stock en logistica
        $logistica->stock -= $quantity;
        $logistica->save();

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Producto añadido al carrito con éxito.');
    }

    public function removeCarrito($id_orden)
    {
        // Obtener las compras y logistica relacionadas
        $compra = Compra::where('id_orden', $id_orden)->first();
        if ($compra) {
            Logistica::where('n_orden', $id_orden)->delete();
            $compra->delete();
        }

        return redirect()->route('carrito.index')->with('success', 'Compra eliminada del carrito.');
    }

    public function updateCarrito(Request $request)
    {
        $validated = $request->validate([
            'id_logistica' => 'required|exists:logisticas,Id_Logistica',
            'quantity' => 'required|integer|min:1',
        ]);

        $logistica = Logistica::find($validated['id_logistica']);
        if ($logistica) {
            // Actualizar la cantidad en logistica
            $logistica->Cantidad = $validated['quantity'];
            $logistica->save();
        }

        return redirect()->route('carrito.index')->with('success', 'Cantidad actualizada con éxito.');
    }
    
    public function generarPedido(Request $request)
    {
        
        // Obtener el usuario autenticado
        $usuario = Auth::user();

        // Generar números de pedido y envío
        $n_pedido = 'PED' . $usuario->id . Carbon::now()->format('YmdHis');
        $n_envio = 'ENV' . $usuario->id . Carbon::now()->format('YmdHis');

        // Obtener la orden seleccionada
        $idOrdenSeleccionada = $request->input('id_orden');

        // Actualizar la orden seleccionada
        Compra::where('id_orden', $idOrdenSeleccionada)
            ->update([
                'id_pedido' => $n_pedido,
                'id_envio' => $n_envio,
                'Estado' => 'P',
            ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('carrito.index')->with('success', 'Pedido generado y orden actualizada correctamente.');
    }
}



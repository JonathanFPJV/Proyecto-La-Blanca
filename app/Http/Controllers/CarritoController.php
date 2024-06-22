<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito.index', compact('carrito'));
    }

    public function add(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                "nombre" => $producto->Nombre_producto,
                "cantidad" => 1,
                "precio" => $producto->Precio,
                "imagen" => $producto->imagen
            ];
        }

        session()->put('carrito', $carrito);
        return redirect()->back()->with('success', 'Producto añadido al carrito');
    }

    public function remove($id)
    {
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }
        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }

    public function checkout()
    {
        $carrito = session()->get('carrito');
        return view('checkout', compact('carrito'));
    }

    public function processCheckout(Request $request)
    {
        $pedido = new Pedido();
        $pedido->user_id = auth()->id();
        $pedido->Estado = 'Pendiente';
        $pedido->Fecha_pedido = now();
        $pedido->Monto_total = $request->total;
        $pedido->save();

        foreach (session('carrito') as $id => $detalles) {
            $producto = Producto::find($id);
            $pedido->productos()->attach($producto, ['cantidad' => $detalles['cantidad'], 'precio' => $detalles['precio']]);
            $producto->stock -= $detalles['cantidad'];
            $producto->save();
        }

        session()->forget('carrito');

        // Generar boleta en PDF
        $pdf = Pdf::loadView('boleta', compact('pedido'));
        return $pdf->download('boleta.pdf');

        return redirect()->route('pedidos')->with('success', 'Compra realizada con éxito');
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Envio;
use App\Models\HistorialPedidosUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::where('user_id', auth()->id())->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function show($numero_pedido, $numero_envio)
    {
        $historialPedidoUsuario = HistorialPedidosUsuario::where('numero_Pedido', $numero_pedido)
                                                        ->where('numero_envio', $numero_envio)
                                                        ->get();

        if ($historialPedidoUsuario->isEmpty()) {
            return redirect()->route('admin.pedidos.index')->with('error', 'No se encontraron productos para el pedido y envío especificados.');
        }

        return view('admin.pedidos.show', compact('historialPedidoUsuario'));
    }


    public function adminIndex(Request $request)
    {
        $query = HistorialPedidosUsuario::query();

        if ($request->filled('nombre_usuario')) {
            $query->where(DB::raw("CONCAT(Nombre_Completo, ' ', Apellido)"), 'like', '%' . $request->nombre_usuario . '%');
        }

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('estado_envio')) {
            $query->where('estado_envio', $request->estado_envio);
        }

        if ($request->filled('numero_pedido')) {
            $query->where('numero_Pedido', 'like', '%' . $request->numero_pedido . '%');
        }

        if ($request->filled('numero_envio')) {
            $query->where('numero_envio', 'like', '%' . $request->numero_envio . '%');
        }

        $historialPedidos = $query->select('ID', 'numero_Pedido', 'numero_envio', 'Nombre_Completo', 'Fecha_pedido', 'estado_pedido', 'estado_envio', 'monto_total_pedido')
                                ->groupBy('ID', 'numero_Pedido', 'numero_envio', 'Nombre_Completo', 'Fecha_pedido', 'estado_pedido', 'estado_envio', 'monto_total_pedido')
                                ->get();

        return view('admin.pedidos.index', compact('historialPedidos'));
    }

    
    public function adminshow()
    {
        return view('pedidos.show');
    }

    
    // funciones para cambiar el esado de pedido y envio
    public function updatePedido(Request $request, $numeroPedido)
    {
        $request->validate([
            'estado_pedido' => 'required|string|max:255',
        ]);

        $pedido = Pedido::where('n_Pedido', $numeroPedido)->firstOrFail();
        $pedido->estado = $request->estado_pedido;
        $pedido->save();

        return redirect()->route('admin.pedidos.show')->with('success', 'Estado del pedido actualizado con éxito.');
    }

    public function updateEnvio(Request $request, $numeroEnvio)
    {
        $request->validate([
            'estado_envio' => 'required|string|max:255',
        ]);

        $envio = Envio::where('n_envio', $numeroEnvio)->firstOrFail();
        $envio->Estado = $request->estado_envio;
        $envio->save();

        return redirect()->route('admin.pedidos.show')->with('success', 'Estado del envío actualizado con éxito.');
    }


    public function updateStatus(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->Estado = $request->Estado;
        $pedido->save();

        return redirect()->route('admin.pedidos')->with('success', 'Estado del pedido actualizado con éxito');
    }

    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

        return redirect()->route('admin.pedidos')->with('success', 'Pedido eliminado con éxito');
    }
}

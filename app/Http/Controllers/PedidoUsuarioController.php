<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PedidoUsuario;
use App\Models\HistorialPedidosUsuario;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

class PedidoUsuarioController extends Controller
{
    public function index()
    {
        // Obtener todos los pedidos del usuario autenticado
        $pedidos = PedidoUsuario::where('id', Auth::id())->get();

        // Pasar los datos a la vista para mostrarlos
        return view('pedidos.index', compact('pedidos'));
    }
    public function show($numeroPedido)
    {
        $productos = HistorialPedidosUsuario::where('numero_Pedido', $numeroPedido)->get();
        // Para cada producto, obtener la imagen desde la tabla de productos
        foreach ($productos as $producto) {
            $producto->imagen = Producto::where('Id_Producto', $producto->Id_Producto)->value('imagen');
        }
        return view('pedidos.detalles', compact('productos'));
    }
}

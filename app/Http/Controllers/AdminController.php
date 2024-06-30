<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\Almacen;
use PDF;
use App\Http\Controllers\ChartController;

class AdminController extends Controller
{
    public function index(Request $request, ChartController $chartController)
    {
        $almacenId = $request->input('almacen_id');
        $productosVendidosChart = $chartController->createProductosVendidosChart();
        $stockPorAlmacenChart = $chartController->createStockPorAlmacenChart($almacenId);
        $almacenes = Almacen::all();

        return view('admin.dashboard', [
            'productosVendidosChart' => $productosVendidosChart,
            'stockPorAlmacenChart' => $stockPorAlmacenChart,
            'almacenes' => $almacenes,
        ]);
    }

    public function productos()
    {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    public function crearProducto()
    {
        return view('admin.productos.create');
    }

    public function guardarProducto(Request $request)
    {
        $request->validate([
            'Codigo_producto' => 'required',
            'Nombre_producto' => 'required',
            'Descripcion' => 'required',
            'Precio' => 'required|numeric',
            'Talla' => 'required',
            'Color' => 'required',
            'imagen' => 'nullable|image'
        ]);

        $producto = new Producto();
        $producto->Codigo_producto = $request->Codigo_producto;
        $producto->Nombre_producto = $request->Nombre_producto;
        $producto->Descripcion = $request->Descripcion;
        $producto->Precio = $request->Precio;
        $producto->Talla = $request->Talla;
        $producto->Color = $request->Color;

        if ($request->hasFile('imagen')) {
            $producto->imagen = $request->file('imagen')->store('imagenes_productos');
        }

        $producto->save();

        return redirect()->route('admin.productos')->with('success', 'Producto creado exitosamente');
    }

    public function editarProducto($id)
    {
        $producto = Producto::findOrFail($id);
        return view('admin.productos.edit', compact('producto'));
    }

    public function actualizarProducto(Request $request, $id)
    {
        $request->validate([
            'Codigo_producto' => 'required',
            'Nombre_producto' => 'required',
            'Descripcion' => 'required',
            'Precio' => 'required|numeric',
            'Talla' => 'required',
            'Color' => 'required',
            'imagen' => 'nullable|image'
        ]);

        $producto = Producto::findOrFail($id);
        $producto->Codigo_producto = $request->Codigo_producto;
        $producto->Nombre_producto = $request->Nombre_producto;
        $producto->Descripcion = $request->Descripcion;
        $producto->Precio = $request->Precio;
        $producto->Talla = $request->Talla;
        $producto->Color = $request->Color;

        if ($request->hasFile('imagen')) {
            $producto->imagen = $request->file('imagen')->store('imagenes_productos');
        }

        $producto->save();

        return redirect()->route('admin.productos')->with('success', 'Producto actualizado exitosamente');
    }

    public function eliminarProducto($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('admin.productos')->with('success', 'Producto eliminado exitosamente');
    }

    public function pedidos()
    {
        $pedidos = Pedido::all();
        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function almacenes()
    {
        $almacenes = Almacen::all();
        return view('admin.almacenes.index', compact('almacenes'));
    }

    public function generarReporteVentas()
    {
        $pedidos = Pedido::all();
        $pdf = PDF::loadView('admin.reportes.ventas', compact('pedidos'));
        return $pdf->download('reporte_ventas.pdf');
    }
}

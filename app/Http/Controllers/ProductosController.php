<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Almacen;
use App\Models\Logistica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $almacenes = Almacen::all();
        return view('productos.create', compact('almacenes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Codigo_producto' => 'required|string|max:255',
            'Nombre_producto' => 'required|string|max:255',
            'Descripcion' => 'required|string',
            'Precio' => 'required|numeric',
            'Categoria' => 'required|string|max:255',
            'Talla' => 'required|string|max:255',
            'Color' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'almacen_id' => 'required|integer|exists:almacenes,Id_Almacen',
            'stock' => 'required|integer',
        ]);

        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('productos', 'public');
        }

        // Crear el producto
        $producto = Producto::create(array_merge($request->all(), ['imagen' => $imagePath ?? null]));

        // Crear el registro de logística
        Logistica::create([
            'Id_usuario' => Auth::id(),
            'Id_Producto' => $producto->Id_Producto,
            'Id_Almacen' => $request->almacen_id,
            'stock' => $request->stock,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto y logística creados exitosamente.');
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $almacenes = Almacen::all();
        return view('productos.edit', compact('producto', 'almacenes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Codigo_producto' => 'required|string|max:255',
            'Nombre_producto' => 'required|string|max:255',
            'Descripcion' => 'required|string',
            'Precio' => 'required|numeric',
            'Categoria' => 'required|string|max:255',
            'Talla' => 'required|string|max:255',
            'Color' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'almacen_id' => 'required|integer|exists:almacenes,Id_Almacen',
            'stock' => 'required|integer',
        ]);

        $producto = Producto::findOrFail($id);

        if ($request->hasFile('imagen')) {
            // Borrar la imagen anterior si existe
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $imagePath = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update(array_merge($request->all(), ['imagen' => $imagePath ?? $producto->imagen]));

        // Actualizar el registro de logística
        $logistica = Logistica::where('Id_Producto', $id)->first();
        $logistica->update([
            'Id_usuario' => Auth::id(),
            'Id_Almacen' => $request->almacen_id,
            'stock' => $request->stock,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto y logística actualizados exitosamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        // Borrar la imagen del producto
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        // Eliminar el registro de logística
        Logistica::where('Id_Producto', $id)->delete();

        return redirect()->route('productos.index')->with('success', 'Producto y logística eliminados exitosamente.');
    }
}

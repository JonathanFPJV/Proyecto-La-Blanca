<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Almacen;
use App\Models\Logistica;
use App\Models\Categoria;
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
        $categorias = Categoria::all();
        return view('productos.create', compact('almacenes', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Codigo_producto' => 'required|string|max:255',
            'Nombre_producto' => 'required|string|max:255',
            'Descripcion' => 'required|string',
            'Precio' => 'required|numeric',
            'id_categoria' => 'required|integer|exists:categorias,id',
            'Talla' => 'required|string|max:255',
            'Color' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'almacen_id' => 'required|integer|exists:almacenes,Id_Almacen',
            'stock' => 'required|integer',
        ]);

        // Verificar si el código del producto ya existe
        if (Producto::where('Codigo_producto', $request->Codigo_producto)->exists()) {
            return redirect()->back()->withErrors(['Codigo_producto' => 'El código del producto ya existe.'])->withInput();
        }
        
        $folder = 'productos/' . $request->Codigo_producto;

        $data = $request->all();
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store($folder, 'public');
        }
        if ($request->hasFile('image_1')) {
            $data['image_1'] = $request->file('image_1')->store($folder, 'public');
        }
        if ($request->hasFile('image_2')) {
            $data['image_2'] = $request->file('image_2')->store($folder, 'public');
        }
        if ($request->hasFile('image_3')) {
            $data['image_3'] = $request->file('image_3')->store($folder, 'public');
        }
        if ($request->hasFile('image_4')) {
            $data['image_4'] = $request->file('image_4')->store($folder, 'public');
        }

        // Crear el producto
        $producto = Producto::create($data);

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
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'almacenes', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Codigo_producto' => 'required|string|max:255',
            'Nombre_producto' => 'required|string|max:255',
            'Descripcion' => 'required|string',
            'Precio' => 'required|numeric',
            'id_categoria' => 'required|integer|exists:categorias,id',
            'Talla' => 'required|string|max:255',
            'Color' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'almacen_id' => 'required|integer|exists:almacenes,Id_Almacen',
            'stock' => 'required|integer',
        ]);

        $producto = Producto::findOrFail($id);

        $folder = 'productos/' . $producto->Codigo_producto;

        $data = $request->all();
        if ($request->hasFile('imagen')) {
            // Borrar la imagen anterior si existe
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store($folder, 'public');
        }
        if ($request->hasFile('image_1')) {
            if ($producto->image_1) {
                Storage::disk('public')->delete($producto->image_1);
            }
            $data['image_1'] = $request->file('image_1')->store($folder, 'public');
        }
        if ($request->hasFile('image_2')) {
            if ($producto->image_2) {
                Storage::disk('public')->delete($producto->image_2);
            }
            $data['image_2'] = $request->file('image_2')->store($folder, 'public');
        }
        if ($request->hasFile('image_3')) {
            if ($producto->image_3) {
                Storage::disk('public')->delete($producto->image_3);
            }
            $data['image_3'] = $request->file('image_3')->store($folder, 'public');
        }
        if ($request->hasFile('image_4')) {
            if ($producto->image_4) {
                Storage::disk('public')->delete($producto->image_4);
            }
            $data['image_4'] = $request->file('image_4')->store($folder, 'public');
        }

        $producto->update($data);

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

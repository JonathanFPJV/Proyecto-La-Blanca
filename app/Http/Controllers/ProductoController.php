<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        $categorias = Categoria::all();
        return view('home', compact('productos', 'categorias'));
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('producto', compact('producto'));
    }

    public function polos()
    {
        $categoria = Categoria::where('nombre_categoria', 'polos')->firstOrFail();
        $productos = Producto::where('id_categoria', $categoria->id)->get();
        return view('categorias.polos', compact('productos'));
    }

    public function pantalones()
    {
        $categoria = Categoria::where('nombre_categoria', 'pantalones')->firstOrFail();
        $productos = Producto::where('id_categoria', $categoria->id)->get();
        return view('categorias.pantalones', compact('productos'));
    }

    public function gorras()
    {
        $categoria = Categoria::where('nombre_categoria', 'gorras')->firstOrFail();
        $productos = Producto::where('id_categoria', $categoria->id)->get();
        return view('categorias.gorras', compact('productos'));
    }

    public function poleras()
    {
        $categoria = Categoria::where('nombre_categoria', 'poleras')->firstOrFail();
        $productos = Producto::where('id_categoria', $categoria->id)->get();
        return view('categorias.poleras', compact('productos'));
    }

    public function zapatillas()
    {
        $categoria = Categoria::where('nombre_categoria', 'zapatillas')->firstOrFail();
        $productos = Producto::where('id_categoria', $categoria->id)->get();
        return view('categorias.zapatillas', compact('productos'));
    }

    public function medias()
    {
        $categoria = Categoria::where('nombre_categoria', 'medias')->firstOrFail();
        $productos = Producto::where('id_categoria', $categoria->id)->get();
        return view('categorias.medias', compact('productos'));
    }

    public function adminIndex()
    {
        $productos = Producto::all();
        return view('admin.productos', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_producto' => 'required',
            'Descripcion' => 'required',
            'Precio' => 'required|numeric',
            'imagen' => 'required|image',
            'id_categoria' => 'required|exists:categorias,id'
        ]);

        $producto = new Producto;
        $producto->Nombre_producto = $request->Nombre_producto;
        $producto->Descripcion = $request->Descripcion;
        $producto->Precio = $request->Precio;
        $producto->imagen = $request->file('imagen')->store('productos', 'public');
        $producto->id_categoria = $request->id_categoria;
        $producto->save();

        return redirect()->route('admin.productos.index')->with('success', 'Producto añadido con éxito');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre_producto' => 'required',
            'Descripcion' => 'required',
            'Precio' => 'required|numeric',
            'imagen' => 'image',
            'id_categoria' => 'required|exists:categorias,id'
        ]);

        $producto = Producto::findOrFail($id);
        $producto->Nombre_producto = $request->Nombre_producto;
        $producto->Descripcion = $request->Descripcion;
        $producto->Precio = $request->Precio;
        if ($request->hasFile('imagen')) {
            $producto->imagen = $request->file('imagen')->store('productos', 'public');
        }
        $producto->id_categoria = $request->id_categoria;
        $producto->save();

        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado con éxito');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado con éxito');
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required|string|max:100',
        ]);

        $categoria = new Categoria();
        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->save();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría añadida con éxito');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_categoria' => 'required|string|max:100',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->save();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada con éxito');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría eliminada con éxito');
    }
}

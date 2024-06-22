<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    public function index()
    {
        $favoritos = auth()->user()->favoritos;
        return view('favoritos.index', compact('favoritos'));
    }

    public function add($id)
    {
        $producto = Producto::findOrFail($id);
        auth()->user()->favoritos()->attach($producto);

        return redirect()->back()->with('success', 'Producto añadido a favoritos');
    }

    public function remove($id)
    {
        $producto = Producto::findOrFail($id);
        auth()->user()->favoritos()->detach($producto);

        return redirect()->back()->with('success', 'Producto eliminado de favoritos');
    }
}

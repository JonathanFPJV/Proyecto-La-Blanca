<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Producto;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, $producto_id)
    {
        $request->validate([
            'Puntuacion' => 'required|integer|min:1|max:5',
            'Comentario' => 'required|string',
        ]);

        $comentario = new Comentario();
        $comentario->Puntuacion = $request->Puntuacion;
        $comentario->Comentario = $request->Comentario;
        $comentario->ID_Usuario = auth()->id();
        $comentario->Id_Producto = $producto_id;
        $comentario->Fecha = now();
        $comentario->estado = 'visible';
        $comentario->save();

        return redirect()->back()->with('success', 'Comentario añadido con éxito');
    }

    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);
        $comentario->delete();

        return redirect()->back()->with('success', 'Comentario eliminado con éxito');
    }
}

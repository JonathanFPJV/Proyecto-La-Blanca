<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function store(Request $request, $producto_id)
    {
        $request->validate([
            'Puntuacion' => 'required|integer|min:1|max:5',
            'Comentario' => 'required|string',
            'Id_Producto' => 'required|integer|exists:productos,id_producto',
        ]);

        Comentario::create([
            'Puntuacion' => $request->Puntuacion,
            'Fecha' => now(),
            'Comentario' => $request->Comentario,
            'ID_Usuario' => auth()->id(),
            'Id_Producto' => $producto_id,
            'estado' => 'visible',
        ]);

        return redirect()->back()->with('success', 'Comentario añadido con éxito');
    }

    public function edit($id)
    {
        $comentario = Comentario::findOrFail($id);

        if ($comentario->ID_Usuario !== Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para editar este comentario.');
        }

        return view('comentarios.edit', compact('comentario'));
    }

    public function update(Request $request, $id)
    {
        $comentario = Comentario::findOrFail($id);

        if ($comentario->ID_Usuario !== Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para editar este comentario.');
        }

        $request->validate([
            'Puntuacion' => 'required|integer|min:1|max:5',
            'Comentario' => 'required|string|max:255',
        ]);

        $comentario->update([
            'Puntuacion' => $request->Puntuacion,
            'Comentario' => $request->Comentario,
            'fecha_modificacion' => now(),
        ]);

        return redirect()->back()->with('success', 'Comentario actualizado con éxito');
    }

    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);
        $user = Auth::user();

        if ($comentario->ID_Usuario !== $user->id && $user->ID_Tipo !== 1) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar este comentario.');
        }

        $comentario->delete();

        return redirect()->back()->with('success', 'Comentario eliminado con éxito');
    }
}

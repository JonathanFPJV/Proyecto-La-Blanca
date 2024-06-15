<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentariosController extends Controller
{
    public function create($productoId)
    {
        $producto = Producto::findOrFail($productoId);
        return view('comentarios.create', compact('producto'));
    }

    public function store(Request $request, $productoId)
    {
        $request->validate([
            'Puntuacion' => 'required|integer|min:1|max:5',
            'Comentario' => 'required|string',
        ]);

        Comentario::create([
            'Puntuacion' => $request->Puntuacion,
            'Fecha' => now(),
            'Comentario' => $request->Comentario,
            'ID_Usuario' => Auth::id(),
            'Id_Producto' => $productoId,
            'estado' => 'activo',
        ]);

        return redirect()->route('productos.show', $productoId)->with('success', 'Comentario agregado exitosamente.');
    }

    public function edit($id)
    {
        $comentario = Comentario::findOrFail($id);
        $this->authorize('update', $comentario);
        return view('comentarios.edit', compact('comentario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Puntuacion' => 'required|integer|min:1|max:5',
            'Comentario' => 'required|string',
        ]);

        $comentario = Comentario::findOrFail($id);
        $this->authorize('update', $comentario);

        $comentario->update([
            'Puntuacion' => $request->Puntuacion,
            'Comentario' => $request->Comentario,
            'fecha_modificacion' => now(),
        ]);

        return redirect()->route('productos.show', $comentario->Id_Producto)->with('success', 'Comentario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);
        $this->authorize('delete', $comentario);

        $comentario->delete();

        return redirect()->route('productos.show', $comentario->Id_Producto)->with('success', 'Comentario eliminado exitosamente.');
    }
}

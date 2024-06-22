<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    public function index()
    {
        $almacenes = Almacen::all();
        return view('admin.almacenes.index', compact('almacenes'));
    }

    public function create()
    {
        return view('admin.almacenes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_almacen' => 'required',
            'Direccion_almacen' => 'required',
            'Capacidad' => 'required|numeric',
            'estado' => 'required',
            'tipo' => 'required',
        ]);

        $almacen = new Almacen;
        $almacen->Nombre_almacen = $request->Nombre_almacen;
        $almacen->Direccion_almacen = $request->Direccion_almacen;
        $almacen->Capacidad = $request->Capacidad;
        $almacen->capacidad_disponible = $request->Capacidad;
        $almacen->estado = $request->estado;
        $almacen->tipo = $request->tipo;
        $almacen->save();

        return redirect()->route('admin.almacenes.index')->with('success', 'Almacén añadido con éxito');
    }

    public function edit($id)
    {
        $almacen = Almacen::findOrFail($id);
        return view('admin.almacenes.edit', compact('almacen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre_almacen' => 'required',
            'Direccion_almacen' => 'required',
            'Capacidad' => 'required|numeric',
            'estado' => 'required',
            'tipo' => 'required',
        ]);

        $almacen = Almacen::findOrFail($id);
        $almacen->Nombre_almacen = $request->Nombre_almacen;
        $almacen->Direccion_almacen = $request->Direccion_almacen;
        $almacen->Capacidad = $request->Capacidad;
        $almacen->capacidad_disponible = $request->Capacidad - ($almacen->Capacidad - $almacen->capacidad_disponible);
        $almacen->estado = $request->estado;
        $almacen->tipo = $request->tipo;
        $almacen->save();

        return redirect()->route('admin.almacenes.index')->with('success', 'Almacén actualizado con éxito');
    }

    public function destroy($id)
    {
        $almacen = Almacen::findOrFail($id);
        $almacen->delete();

        return redirect()->route('admin.almacenes.index')->with('success', 'Almacén eliminado con éxito');
    }
}

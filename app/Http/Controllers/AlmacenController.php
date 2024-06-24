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
            'Capacidad' => 'required|numeric|min:0',
            'estado' => 'required',
            'tipo' => 'required',
        ]);

        // Calculamos la capacidad disponible igual a la capacidad
        $request['capacidad_disponible'] = $request->Capacidad;

        Almacen::create($request->all());

        return redirect()->route('admin.almacenes.index')->with('success', 'Almacén añadido con éxito');
    }

    public function show($id)
    {
        $almacen = Almacen::findOrFail($id);
        return view('admin.almacenes.show', compact('almacen'));
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
            'Capacidad' => 'required|numeric|min:0',
            'capacidad_disponible' => 'required|integer|min:0',
            'estado' => 'required',
            'tipo' => 'required',
        ]);

        $almacen = Almacen::findOrFail($id);
        $almacen->update($request->all());

        return redirect()->route('admin.almacenes.index')->with('success', 'Almacén actualizado con éxito');
    }

    public function destroy($id)
    {
        $almacen = Almacen::findOrFail($id);
        $almacen->delete();

        return redirect()->route('admin.almacenes.index')->with('success', 'Almacén eliminado con éxito');
    }
}

<?php
namespace App\Http\Controllers;

use App\Models\Almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    public function index()
    {
        $almacenes = Almacen::all();
        return view('almacenes.index', compact('almacenes'));
    }

    public function create()
    {
        return view('almacenes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_almacen' => 'required|string|max:255',
            'Direccion_almacen' => 'required|string|max:255',
            'Capacidad' => 'required|integer',
            'estado' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
        ]);

        // Calculamos la capacidad disponible igual a la capacidad
        $request['capacidad_disponible'] = $request->Capacidad;

        Almacen::create($request->all());

        return redirect()->route('almacenes.index')->with('success', 'Almacén creado exitosamente.');
    }


    public function show($id)
    {
        $almacen = Almacen::findOrFail($id);
        return view('almacenes.show', compact('almacen'));
    }

    public function edit($id)
    {
        $almacen = Almacen::findOrFail($id);
        return view('almacenes.edit', compact('almacen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre_almacen' => 'required|string|max:255',
            'Direccion_almacen' => 'required|string|max:255',
            'Capacidad' => 'required|integer',
            'capacidad_disponible' => 'required|integer',
            'estado' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
        ]);

        $almacen = Almacen::findOrFail($id);
        $almacen->update($request->all());

        return redirect()->route('almacenes.index')->with('success', 'Almacén actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $almacen = Almacen::findOrFail($id);
        $almacen->delete();

        return redirect()->route('almacenes.index')->with('success', 'Almacén eliminado exitosamente.');
    }
}


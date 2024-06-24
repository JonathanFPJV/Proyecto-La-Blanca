<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Almacen;
use App\Models\Logistica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogisticaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        $almacenes = Almacen::all();
        return view('admin.logistica.create', compact('productos', 'almacenes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Id_Producto' => 'required|integer|exists:productos,Id_Producto',
            'Id_Almacen' => 'required|integer|exists:almacenes,Id_Almacen',
            'stock' => 'required|integer',
        ]);

        Logistica::create([
            'Id_usuario' => Auth::id(),
            'Id_Producto' => $request->Id_Producto,
            'Id_Almacen' => $request->Id_Almacen,
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin.productos.index')->with('success', 'Logística añadida con éxito');
    }

    public function search(Request $request)
    {
        $request->validate([
            'codigo_producto' => 'required|integer|exists:logisticas,Id_Producto',
        ]);

        $logistica = Logistica::where('Id_Producto', $request->codigo_producto)->first();

        if ($logistica) {
            $productos = Producto::all();
            $almacenes = Almacen::all();
            return view('admin.logistica.create', compact('logistica', 'productos', 'almacenes'));
        } else {
            return redirect()->route('admin.logistica.create')->with('error', 'Producto no encontrado');
        }
    }



    public function update(Request $request, string $id)
    {
        $request->validate([
            'Id_Producto' => 'required|integer|exists:productos,Id_Producto',
            'Id_Almacen' => 'required|integer|exists:almacenes,Id_Almacen',
            'stock' => 'required|integer',
        ]);

        $logistica = Logistica::findOrFail($id);
        $logistica->update([
            'Id_usuario' => Auth::id(),
            'Id_Producto' => $request->Id_Producto,
            'Id_Almacen' => $request->Id_Almacen,
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin.logistica.create')->with('success', 'Logística actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $logistica = Logistica::findOrFail($id);
        $logistica->delete();

        return redirect()->route('admin.logistica.create')->with('success', 'Logística eliminada con éxito');
    }
}

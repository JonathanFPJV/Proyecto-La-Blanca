<?php

namespace App\Http\Controllers;

use App\Models\Logistica;
use Illuminate\Http\Request;

class LogisticaController extends Controller
{
    public function index()
    {
        $logisticas = Logistica::all();
        return view('logistica.index', compact('logisticas'));
    }

    public function show($id)
    {
        $logistica = Logistica::findOrFail($id);
        return view('logistica.show', compact('logistica'));
    }
}

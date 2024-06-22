<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BoletaController extends Controller
{
    public function index()
    {
        $boletas = Boleta::all();
        return view('admin.boletas.index', compact('boletas'));
    }

    public function generatePDF($id)
    {
        $boleta = Boleta::findOrFail($id);
        $pdf = Pdf::loadView('admin.boletas.boleta_pdf', compact('boleta'));
        return $pdf->download('boleta_' . $boleta->numero_boleta . '.pdf');
    }
}

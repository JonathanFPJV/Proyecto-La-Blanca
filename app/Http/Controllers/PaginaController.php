<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginaController extends Controller
{
    public function contactanos()
    {
        return view('paginas.contactanos');
    }

    public function preguntasFrecuentes()
    {
        return view('paginas.preguntasFrecuentes');
    }

    public function ofertasPromociones()
    {
        return view('paginas.ofertasPromociones');
    }

    public function guiaTallas()
    {
        return view('paginas.guiaTallas');
    }

    public function nuestraHistoria()
    {
        return view('paginas.nuestraHistoria');
    }

    public function telasMateriales()
    {
        return view('paginas.telasMateriales');
    }
}


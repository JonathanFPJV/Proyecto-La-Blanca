<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginaController extends Controller
{
    public function contactanos()
    {
        return view('paginas.contactanos');
    }

    public function ofertasPromociones()
    {
        return view('paginas.ofertasPromociones');
    }

    public function nuestraHistoria()
    {
        return view('paginas.nuestraHistoria');
    }

}


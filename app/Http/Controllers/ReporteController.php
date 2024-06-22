<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function ventasPorMes()
    {
        $reportes = DB::table('reporte_ventas_mes')->get();
        return view('admin.reportes.ventas_por_mes', compact('reportes'));
    }

    public function productosVendidos()
    {
        $reportes = DB::table('reporte_productos_vendidos')->get();
        return view('admin.reportes.productos_vendidos', compact('reportes'));
    }
}

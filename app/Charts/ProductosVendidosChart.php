<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class ProductosVendidosChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        // Consulta los datos de la vista
        $result = DB::table('reporte_productos_vendidos')->get();

        // Extrae las etiquetas (nombres de productos) y los datos (cantidad vendida)
        $labels = $result->pluck('Nombre_producto')->toArray();
        $data = $result->pluck('CantidadVendida')->toArray();

        return $this->chart->barChart()
            ->setTitle('Productos Vendidos')
            ->setSubtitle('Cantidad vendida de productos')
            ->addData('Cantidad Vendida', $data)
            ->setXAxis($labels);
    }
}

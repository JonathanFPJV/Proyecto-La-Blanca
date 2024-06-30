<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class StockPorAlmacenChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($almacenId = null)
    {
        // Consulta los datos de la vista, con opción de filtrar por almacén
        $query = DB::table('vista_stock_por_almacen');
        
        if ($almacenId) {
            $query->where('Id_Almacen', $almacenId);
        }

        $result = $query->get();

        // Extrae las etiquetas combinando nombre del almacén y nombre del producto
        $labels = $result->map(function ($item) {
            return $item->Nombre_almacen . ' - ' . $item->Nombre_producto;
        })->toArray();
        
        // Extrae los datos (stock disponible)
        $data = $result->pluck('Stock_Disponible')->toArray();

        return $this->chart->barChart()
            ->setTitle('Stock por Almacén y Producto')
            ->setSubtitle('Stock disponible de productos por almacén')
            ->addData('Stock Disponible', $data)
            ->setXAxis($labels)
            ->setColors(['#FF5733', '#33FF57', '#3357FF']) // Colores de ejemplo, ajusta según necesites
            ->setGrid(true, true, true, true);
    }
}


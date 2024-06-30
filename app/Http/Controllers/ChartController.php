<?php

// app/Http/Controllers/ChartController.php

namespace App\Http\Controllers;

use App\Charts\ProductosVendidosChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Charts\StockPorAlmacenChart;

class ChartController extends Controller
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function createProductosVendidosChart()
    {
        $chartInstance = new ProductosVendidosChart($this->chart);
        return $chartInstance->build();
    }

    public function createStockPorAlmacenChart($almacenId = null)
    {
        $chartInstance = new StockPorAlmacenChart($this->chart);
        return $chartInstance->build($almacenId);
    }

    
}

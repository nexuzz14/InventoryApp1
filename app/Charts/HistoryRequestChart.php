<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class HistoryRequestChart extends Chart
{
    protected $chart;
    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        parent::__construct();

    }

    public function build()
    {
        return $this->chart->areaChart()
        ->addData('Jumlah Permintaan Barang', [40, 93, 35, 42, 18, 82])
        ->addData('Jumlah Penambahan Barang', [70, 29, 77, 28, 55, 45])
        ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June'])
        ->setToolbar(true)
        ->setHeight(200);
    }
}

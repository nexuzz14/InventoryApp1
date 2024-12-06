<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class MonthlyUsersChart extends Chart
{
    protected $chart;
    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        parent::__construct();
    }

    public function build()
    {
        return $this->chart->polarAreaChart()
            ->setToolbar(true)
            ->setTitle('Top 3 Barang dengan Permintaan Terbanyak.')
            ->setSubtitle('Dalam 1 Bulan.')
            ->addData([20, 24, 30])
            ->setLabels(['Player 7', 'Player 10', 'Player 9']);
    }
}

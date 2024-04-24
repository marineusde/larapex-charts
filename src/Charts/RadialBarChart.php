<?php

namespace marineusde\LarapexCharts\Charts;

use marineusde\LarapexCharts\Contracts\MustAddSimpleData;
use marineusde\LarapexCharts\LarapexChart;
use marineusde\LarapexCharts\Traits\SimpleChartDataAggregator;

class RadialBarChart extends LarapexChart implements MustAddSimpleData
{
    use SimpleChartDataAggregator;

    public function __construct()
    {
        parent::__construct();
        $this->type = 'radialBar';
    }

    public function addRings(array $data): RadialBarChart
    {
        $this->addData($data);
        return $this;
    }
}

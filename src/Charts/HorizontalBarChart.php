<?php

namespace marineusde\LarapexCharts\Charts;

use marineusde\LarapexCharts\Contracts\MustAddComplexData;
use marineusde\LarapexCharts\LarapexChart;
use marineusde\LarapexCharts\Traits\ComplexChartDataAggregator;

class HorizontalBarChart extends LarapexChart implements MustAddComplexData
{
    use ComplexChartDataAggregator;

    public function __construct()
    {
        parent::__construct();
        $this->type = 'bar';
        $this->horizontal = json_encode(['horizontal' => true]);
    }

    public function addBar(string $name, array $data): HorizontalBarChart
    {
        return $this->addData($name, $data);
    }
}

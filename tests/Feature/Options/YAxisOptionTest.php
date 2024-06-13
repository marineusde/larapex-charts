<?php

namespace marineusde\LarapexCharts\Tests\Feature\Options;

use marineusde\LarapexCharts\Charts\BarChart;
use marineusde\LarapexCharts\Options\YAxisOption;
use marineusde\LarapexCharts\Tests\TestCase;

class YAxisOptionTest extends TestCase
{
    public function test_set_y_axis(): void
    {
        $chart = (new BarChart)
            ->setYAxisOption(new YAxisOption(0, 10, 1));

        $options = $chart->getDefaultOptions();
        $this->assertNotNull($options['yaxis']);
        $this->assertIsArray($options['yaxis']);

        $yAxis = $options['yaxis'];

        $this->assertSame(true, $yAxis['show']);
        $this->assertSame(0, $yAxis['min']);
        $this->assertSame(10, $yAxis['max']);
        $this->assertSame(1, $yAxis['tickAmount']);
    }

    public function test_set_y_axis_without_tick_amount(): void
    {
        $chart = (new BarChart)
            ->setYAxisOption(new YAxisOption(0, 10));

        $options = $chart->getDefaultOptions();
        $this->assertNotNull($options['yaxis']);
        $this->assertIsArray($options['yaxis']);

        $yAxis = $options['yaxis'];

        $this->assertSame(true, $yAxis['show']);
        $this->assertSame(0, $yAxis['min']);
        $this->assertSame(10, $yAxis['max']);
        $this->assertSame(10, $yAxis['tickAmount']);
    }

    public function test_not_set(): void
    {
        $chart = (new BarChart);

        $options = $chart->getDefaultOptions();

        $this->assertNull($options['chart']['animations'] ?? null);
    }
}

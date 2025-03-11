<?php

namespace marineusde\LarapexCharts\Tests\Feature\Options;

use marineusde\LarapexCharts\Charts\BarChart;
use marineusde\LarapexCharts\Options\XAxisOption;
use marineusde\LarapexCharts\Tests\TestCase;

class XAxisOptionTest extends TestCase
{
    public function test_set_x_axis(): void
    {
        $chart = (new BarChart)
            ->setXAxisOption(new XAxisOption(['test']));

        $options = $chart->getDefaultOptions();
        $this->assertNotNull($options['xaxis']);
        $this->assertIsArray($options['xaxis']);

        $xaxis = $options['xaxis'];

        $this->assertSame('true', $xaxis['labels']['show']);

        $this->assertIsArray($xaxis['categories']);

        $this->assertSame(['test'], $xaxis['categories']);
    }
}

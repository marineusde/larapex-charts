<?php

namespace marineusde\LarapexCharts\Tests\Feature\Options;

use marineusde\LarapexCharts\Charts\BarChart;
use marineusde\LarapexCharts\Options\Data\Colors;
use marineusde\LarapexCharts\Options\GridOption;
use marineusde\LarapexCharts\Tests\TestCase;

class GridOptionTest extends TestCase
{
    public function test_set_grid_option(): void
    {
        $gridOption = (new GridOption)
            ->setShow()
            ->setStrokeDashArray(1)
            ->setShowAxis()
            ->setBorderColor('red')
            ->setPosition('back')
            ->setPadding(10, 20, 30, 40)
            ->setRowColors(new Colors(['red', 'blue'], 0.5))
            ->setColumnColors(new Colors(['orange', 'black'], 0.7));

        $chart = (new BarChart)
            ->setGridOptions($gridOption);

        $options = $chart->getDefaultOptions();

        $this->assertNotNull($options['grid']);
        $this->assertIsArray($options['grid']);

        $this->assertSame([
            'show' => 'true',
            'xaxis' => [
                'lines' => [
                    'show' => 'true'
                ]
            ],
            'yaxis' => [
                'lines' => [
                    'show' => 'true'
                ]
            ],
            'strokeDashArray' => 1,
            'padding' => [
                'top' => 10,
                'right' => 20,
                'bottom' => 30,
                'left' => 40
            ],
            'position' => 'back',
            'borderColor' => 'red',
            'row' => [
                'colors' => [
                    0 => 'red',
                    1 => 'blue'
                ],
                'opacity' => 0.5
            ],
            'column' => [
                'colors' => [
                    0 => 'orange',
                    1 => 'black'
                ],
                'opacity' => 0.7
            ]
        ], $options['grid']);
    }

    public function test_set_no_show(): void
    {
        $gridOption = (new GridOption)
            ->setShow(false)
            ->setShowAxis(false, false);

        $chart = (new BarChart)
            ->setGridOptions($gridOption);

        $options = $chart->getDefaultOptions();
        $this->assertNotNull($options['grid']);
        $this->assertIsArray($options['grid']);

        $this->assertSame([
            'show' => 'false',
            'xaxis' => [
                'lines' => [
                    'show' => 'false'
                ]
            ],
            'yaxis' => [
                'lines' => [
                    'show' => 'false'
                ]
            ]
        ], $options['grid']);
    }
}

<?php

namespace marineusde\LarapexCharts\Tests\Feature\Options;

use marineusde\LarapexCharts\Charts\BarChart;
use marineusde\LarapexCharts\Enums\ChartAnimationOptionEasing;
use marineusde\LarapexCharts\LarapexChart;
use marineusde\LarapexCharts\Options\ChartAnimationOption;
use marineusde\LarapexCharts\Options\YAxisOption;
use marineusde\LarapexCharts\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class ChartAnimationOptionTest extends TestCase
{
    public function test_default(): void
    {
        $chart = (new BarChart)
            ->setChartAnimationOption(new ChartAnimationOption(true));

        $animations = $this->getAnimationFromOptions($chart);

        $this->assertTrue($animations['enabled']);
        $this->assertSame('easein', $animations['easing']);
        $this->assertSame(800, $animations['speed']);

        $this->assertIsArray($animations['animateGradually']);
        $this->assertSame(true, $animations['animateGradually']['enabled']);
        $this->assertSame(150, $animations['animateGradually']['delay']);

        $this->assertIsArray($animations['dynamicAnimation']);
        $this->assertSame(true, $animations['dynamicAnimation']['enabled']);
        $this->assertSame(350, $animations['dynamicAnimation']['speed']);
    }

    public function test_set_disabled(): void
    {
        $chart = (new BarChart)
            ->setChartAnimationOption(new ChartAnimationOption(false));

        $animations = $this->getAnimationFromOptions($chart);

        $this->assertFalse($animations['enabled']);
    }

    public function test_set_all_data(): void
    {
        $option = (new ChartAnimationOption())
            ->setEasing(ChartAnimationOptionEasing::EASEOUT)
            ->setSpeed(500)
            ->setAnimateGradually(false, 400)
            ->setDynamicAnimation(false, 600);

        $chart = (new BarChart)
            ->setChartAnimationOption($option);

        $animations = $this->getAnimationFromOptions($chart);

        $this->assertNotNull($animations['easing']);
        $this->assertTrue($animations['enabled']);
        $this->assertSame('easeout', $animations['easing']);
        $this->assertSame(500, $animations['speed']);

        $this->assertIsArray($animations['animateGradually']);
        $this->assertSame(false, $animations['animateGradually']['enabled']);
        $this->assertSame(400, $animations['animateGradually']['delay']);

        $this->assertIsArray($animations['dynamicAnimation']);
        $this->assertSame(false, $animations['dynamicAnimation']['enabled']);
        $this->assertSame(600, $animations['dynamicAnimation']['speed']);
    }

    public static function validOptionEasings(): array
    {
        return [
            [ChartAnimationOptionEasing::LINEAR, 'linear'],
            [ChartAnimationOptionEasing::EASEIN, 'easein'],
            [ChartAnimationOptionEasing::EASEINOUT, 'easeinout'],
            [ChartAnimationOptionEasing::EASEOUT, 'easeout'],
        ];
    }

    #[DataProvider('validOptionEasings')]
    public function test_easings(mixed $easing, string $expectedEasingValue): void
    {
        $option = (new ChartAnimationOption())
            ->setEasing($easing);

        $chart = (new BarChart)
            ->setChartAnimationOption($option);

        $animations = $this->getAnimationFromOptions($chart);

        $this->assertNotNull($animations['easing']);
        $this->assertSame($expectedEasingValue, $animations['easing']);
    }

    public function test_not_set(): void
    {
        $chart = (new BarChart);

        $options = $chart->getDefaultOptions();

        $this->assertNull($options['chart']['animations'] ?? null);
    }

    private function getAnimationFromOptions(LarapexChart $chart): array
    {
        $options = $chart->getDefaultOptions();
        $this->assertNotNull($options['chart']['animations']);
        $this->assertIsArray($options['chart']['animations']);

        return $options['chart']['animations'];
    }
}

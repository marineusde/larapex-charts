<?php

namespace marineusde\LarapexCharts\Tests;

use marineusde\LarapexCharts\Providers\LarapexChartsServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    /**
     * Sets the env data to interact as env file values
     */
    protected function getEnvironmentSetUp(mixed $app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connection.testing', [
            'driver'    => 'sqlite',
            'database'  => ':memory:'
        ]);
    }

    // set providers to test the class
    protected function getPackageProviders($app): array
    {
        return [
            LarapexChartsServiceProvider::class,
        ];
    }

    // With this method I can use the facade instead of all class namespace
    protected function getPackageAliases($app): array
    {
        return [
            'LarapexChart' => \marineusde\LarapexCharts\Facades\LarapexChart::class
        ];
    }
}

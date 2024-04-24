<?php

namespace marineusde\LarapexCharts\Traits;

trait SimpleChartDataAggregator
{
    public function addData(array $data): static
    {
        $this->dataset = json_encode($data);

        return $this;
    }
}

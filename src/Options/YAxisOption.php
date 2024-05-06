<?php

namespace marineusde\LarapexCharts\Options;

use Illuminate\Contracts\Support\Arrayable;

class YAxisOption implements Arrayable
{
    protected bool $show = false;
    protected ?int $min = null;
    protected ?int $max = null;
    protected ?int $tickAmount = null;

    public function __construct(int $min, int $max, ?int $tickAmount = null, bool $show = true)
    {
        $this->min = $min;
        $this->max = $max;
        $this->tickAmount = $tickAmount ?? $max;
        $this->show = $show;
    }

    public function toArray(): array
    {
        return [
            'show' => $this->show,
            'min' => $this->min,
            'max' => $this->max,
            'tickAmount' => $this->tickAmount
        ];
    }
}

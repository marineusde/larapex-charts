<?php

namespace marineusde\LarapexCharts\Options\Data;

use Illuminate\Contracts\Support\Arrayable;

class Colors implements Arrayable
{
    public function __construct(
        public array $colors, public float $opacity = 1.0)
    {

    }

    public function toArray(): array
    {
        return [
            'colors' => $this->colors,
            'opacity' => $this->opacity,
        ];
    }
}

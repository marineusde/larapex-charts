<?php

namespace marineusde\LarapexCharts\Options;

use Illuminate\Contracts\Support\Arrayable;

class XAxisOption implements Arrayable
{
    protected ?bool $showLabels = true;

    public function __construct(protected array $categories)
    {

    }

    public function setShowLabels(bool $showLabels): self
    {
        $this->showLabels = $showLabels;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'categories' => $this->categories,
            'labels' => [
                'show' => $this->showLabels ? 'true' : 'false'
            ]
        ];
    }
}

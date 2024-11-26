<?php

namespace marineusde\LarapexCharts\Options;

use Illuminate\Contracts\Support\Arrayable;
use marineusde\LarapexCharts\Options\Data\Colors;

class GridOption implements Arrayable
{
    protected bool $show = true;
    protected bool $showXAxis = false;
    protected bool $showYAxis = false;
    protected int $strokeDashArray = 0;

    protected ?string $borderColor = null;
    protected ?string $position = null;

    protected ?Colors $rowColors = null;
    protected ?Colors $columnColors = null;

    protected int $paddingTop = 0;
    protected int $paddingRight = 0;
    protected int $paddingBottom = 0;
    protected int $paddingLeft = 0;

    public function setShow(bool $show = true): static
    {
        $this->show = $show;

        return $this;
    }

    public function setShowAxis(bool $showXAxis = true, bool $showYAxis = true): static
    {
        $this->showXAxis = $showXAxis;
        $this->showYAxis = $showYAxis;

        return $this;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function setStrokeDashArray(int $strokeDashArray): static
    {
        $this->strokeDashArray = $strokeDashArray;

        return $this;
    }

    public function setPadding(int $top = 0, int $right = 0, int $bottom = 0, int $left = 0): static
    {
        $this->paddingTop = $top;
        $this->paddingRight = $right;
        $this->paddingBottom = $bottom;
        $this->paddingLeft = $left;

        return $this;
    }

    public function setBorderColor(string $borderColor): static
    {
        $this->borderColor = $borderColor;

        return $this;
    }

    public function setRowColors(Colors $colors): static
    {
        $this->rowColors = $colors;

        return $this;
    }

    public function setColumnColors(Colors $colors): static
    {
        $this->columnColors = $colors;

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'show' => $this->show ? true : false,
            'xaxis' => [
                'lines' => [
                    'show' => $this->showXAxis ? true : false
                ]
            ],
            'yaxis' => [
                'lines' => [
                    'show' => $this->showYAxis ? true : false
                ]
            ]
        ];

        if ($this->strokeDashArray !== 0) {
            $data['strokeDashArray'] = $this->strokeDashArray;
        }

        if ($this->paddingTop !== 0 || $this->paddingRight !== 0 || $this->paddingBottom !== 0 || $this->paddingLeft !== 0) {
            $data['padding'] = [
                'top' => $this->paddingTop,
                'right' => $this->paddingRight,
                'bottom' => $this->paddingBottom,
                'left' => $this->paddingLeft,
            ];
        }

        if ($this->position !== null) {
            $data['position'] = $this->position;
        }

        if ($this->borderColor !== null) {
            $data['borderColor'] = $this->borderColor;
        }

        if ($this->rowColors !== null) {
            $data['row'] = $this->rowColors->toArray();
        }

        if ($this->columnColors !== null) {
            $data['column'] = $this->columnColors->toArray();
        }

        return $data;
    }
}

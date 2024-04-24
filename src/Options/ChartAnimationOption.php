<?php

namespace marineusde\LarapexCharts\Options;

use Illuminate\Contracts\Support\Arrayable;
use marineusde\LarapexCharts\Enums\ChartAnimationOptionEasing;

class ChartAnimationOption implements Arrayable
{
    protected bool $enabled = true;
    protected ChartAnimationOptionEasing $easing;
    protected int $speed = 800;
    protected bool $animateGraduallyEnabled = true;
    protected int $animateGraduallyDelay = 150;
    protected bool $dynamicAnimationEnabled = true;
    protected int $dynamicAnimationSpeed = 350;

    public function __construct(bool $enabled = true)
    {
        $this->enabled = $enabled;
        $this->easing = ChartAnimationOptionEasing::EASEIN;
    }

    public function setEasing(ChartAnimationOptionEasing $easing): static
    {
        $this->easing = $easing;
        return $this;
    }

    public function setSpeed(int $speed): static
    {
        $this->speed = $speed;

        return $this;
    }

    public function setAnimateGradually(bool $enabled, int $delay = 150): static
    {
        $this->animateGraduallyEnabled = $enabled;
        $this->animateGraduallyDelay = $delay;
        return $this;
    }

    public function setDynamicAnimation(bool $enabled, int $speed = 350): static
    {
        $this->dynamicAnimationEnabled = $enabled;
        $this->dynamicAnimationSpeed = $speed;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'enabled' => $this->enabled,
            'easing' => $this->easing->value,
            'speed' => $this->speed,
            'animateGradually' => [
                'enabled' => $this->animateGraduallyEnabled,
                'delay' => $this->animateGraduallyDelay
            ],
            'dynamicAnimation' => [
                'enabled' => $this->dynamicAnimationEnabled,
                'speed' => $this->dynamicAnimationSpeed
            ]
        ];
    }
}

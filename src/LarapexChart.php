<?php

namespace marineusde\LarapexCharts;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use marineusde\LarapexCharts\Options\ChartAnimationOption;
use marineusde\LarapexCharts\Options\GridOption;
use marineusde\LarapexCharts\Options\XAxisOption;
use marineusde\LarapexCharts\Options\YAxisOption;

class LarapexChart
{
    /*
    |--------------------------------------------------------------------------
    | Chart
    |--------------------------------------------------------------------------
    |
    | This class build the chart by passing setters to the object, it will
    | use the method container and scripts to generate a JSON
    | in blade views, it works also with Vue JS components
    |
    */

    public string $id;
    public string $title = '';
    public string $subtitle = '';
    public string $subtitlePosition = 'left';
    public string $type = 'donut';
    public array $labels = [];
    public string $fontFamily;
    public string $foreColor;
    public string $dataset = '';
    public int $height = 500;
    public int|string $width = '100%';
    public string $colors;
    public string $horizontal;
    public string $xAxis;
    public string $markers;
    public bool $stacked = false;
    public bool $showLegend = true;
    public string $stroke = '';
    public string $toolbar;
    public string $zoom;
    public string $dataLabels;
    public string $theme = 'light';
    public string $sparkline;
    public string $chartLetters = 'abcdefghijklmnopqrstuvwxyz';
    public string $dropShadow = '';

    public ?XAxisOption $xAxisOption = null;
    public ?YAxisOption $yAxisOption = null;
    public ?ChartAnimationOption $chartAnimationOption = null;
    protected ?GridOption $gridOption = null;

    public array $additionalOptions = [];

    /*
    |--------------------------------------------------------------------------
    | Constructors
    |--------------------------------------------------------------------------
    */

    public function __construct()
    {
        $this->id = substr(str_shuffle(str_repeat($x = $this->chartLetters, (int) ceil(25 / strlen($x)))), 1, 25);
        $this->horizontal = json_encode(['horizontal' => false]);
        $this->colors = json_encode(config('larapex-charts.colors'));
        $this->markers = json_encode(['show' => false]);
        $this->toolbar = json_encode(['show' => false]);
        $this->zoom = json_encode(['enabled' => true]);
        $this->dataLabels = json_encode(['enabled' => false]);
        $this->sparkline = json_encode(['enabled' => false]);
        $this->fontFamily = config('larapex-charts.font_family');
        $this->foreColor = config('larapex-charts.font_color');
    }

    /*
    |--------------------------------------------------------------------------
    | Setters
    |--------------------------------------------------------------------------
    */

    public function setFontFamily(string $fontFamily): static
    {
        $this->fontFamily = $fontFamily;
        return $this;
    }

    public function setFontColor(string $fontColor): static
    {
        $this->foreColor = $fontColor;
        return $this;
    }

    public function setDataset(array $dataset): static
    {
        $this->dataset = json_encode($dataset);
        return $this;
    }

    public function setHeight(int $height): static
    {
        $this->height = $height;
        return $this;
    }

    public function setWidth(int $width): static
    {
        $this->width = $width;
        return $this;
    }

    public function setColors(array $colors): static
    {
        $this->colors = json_encode($colors);
        return $this;
    }

    public function setHorizontal(bool $horizontal): static
    {
        $this->horizontal = json_encode(['horizontal' => $horizontal]);
        return $this;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function setSubtitle(string $subtitle, string $position = 'left'): static
    {
        $this->subtitle = $subtitle;
        $this->subtitlePosition = $position;
        return $this;
    }

    public function setLabels(array $labels): static
    {
        $this->labels = $labels;
        return $this;
    }

    public function setMarkers(array $colors = [], float $width = 4, float $hoverSize = 7): static
    {
        if (empty($colors)) {
            $colors = config('larapex-charts.colors');
        }

        $this->markers = json_encode([
            'size' => $width,
            'colors' => $colors,
            'strokeColors' => '#fff',
            'strokeWidth' => $width / 2,
            'hover' => [
                'size' => $hoverSize,
            ]
        ]);

        return $this;
    }

    public function setStroke(int $width, array $colors = [], string $curve = 'straight'): static
    {
        if (empty($colors)) {
            $colors = config('larapex-charts.colors');
        }

        $this->stroke = json_encode([
            'show'    =>  true,
            'width'   =>  $width,
            'colors'  =>  $colors,
            'curve'   =>  $curve,
        ]);
        return $this;
    }

    public function setToolbar(bool $show, bool $zoom = true): static
    {
        $this->toolbar = json_encode(['show' => $show]);
        $this->zoom = json_encode(['enabled' => $zoom]);
        return $this;
    }

    public function setDataLabels(bool $enabled = true): static
    {
        $this->dataLabels = json_encode(['enabled' => $enabled]);
        return $this;
    }

    public function setTheme(string $theme): static
    {
        $this->theme = $theme;
        return $this;
    }

    public function setSparkline(bool $enabled = true): static
    {
        $this->sparkline = json_encode(['enabled' => $enabled]);
        return $this;
    }

    public function setStacked(bool $stacked = true): static
    {
        $this->stacked = $stacked;
        return $this;
    }

    public function setShowLegend(bool $showLegend = true): static
    {
        $this->showLegend = $showLegend;
        return $this;
    }

    public function setChartAnimationOption(ChartAnimationOption $chartAnimationOption): static
    {
        $this->chartAnimationOption = $chartAnimationOption;
        return $this;
    }

    public function setYAxisOption(YAxisOption $YAxisOption): static
    {
        $this->yAxisOption = $YAxisOption;
        return $this;
    }

    public function setGridOption(GridOption $gridOption): static
    {
        $this->gridOption = $gridOption;

        return $this;
    }

    public function setXAxisOption(XAxisOption $XAxisOption): static
    {
        $this->xAxisOption = $XAxisOption;

        return $this;
    }

    public function setDropShadow(bool $enabled = true, string|array $color = '#000', int $top = 10, int $left = 5, int $blur = 3, float $opacity = 0.2, ?array $enabledOnSeries = []): static
    {
        $this->dropShadow = json_encode([
            'enabled' => $enabled,
            'enabledOnSeries' => $enabledOnSeries,
            'top' => $top,
            'left' => $left,
            'blur' => $blur,
            'color' => is_array($color) ? $color : [$color],
            'opacity' => $opacity,
        ]);

        return $this;
    }

    public function setAdditionalOptions(array $options): static
    {
        $this->additionalOptions = $options;
        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Methods for Views
    |--------------------------------------------------------------------------
    */

    public function transformLabels(array $array): false|string
    {
        /* @phpstan-ignore-next-line */
        $stringArray = array_filter($array, function ($string) {
            return "{$string}";
        });
        return json_encode(['"' . implode('","', $stringArray) . '"']);
    }

    public function container(): View
    {
        return view('larapex-charts::chart.container', ['id' => $this->id]);
    }

    public function script(): View
    {
        return view('larapex-charts::chart.script', ['chart' => $this]);
    }

    public static function cdn(): string
    {
        return 'https://cdn.jsdelivr.net/npm/apexcharts';
    }

    /*
    |--------------------------------------------------------------------------
    | JSON Options Builder
    |--------------------------------------------------------------------------
    */

    public function toJson(): JsonResponse
    {
        return response()->json([
            'id' => $this->id,
            'options' => $this->getAdditionalOptions(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Vue Options Builder
    |--------------------------------------------------------------------------
    */

    public function toVue(): array
    {
        return [
            'height' => $this->height,
            'width' => $this->width,
            'type' => $this->type,
            'options' => $this->getAdditionalOptions(),
            'series' => json_decode($this->dataset),
        ];
    }

    public function toJsonEncodedString(): string
    {
        return json_encode($this->getAdditionalOptions());
    }

    public function getAdditionalOptions(): array
    {
        return array_replace_recursive($this->getDefaultOptions(), $this->additionalOptions);
    }

    public function getDefaultOptions(): array
    {
        $options = [
            'chart' => [
                'type' => $this->type,
                'height' => $this->height,
                'width' => $this->width,
                'toolbar' => json_decode($this->toolbar),
                'zoom' => json_decode($this->zoom),
                'fontFamily' => json_decode($this->fontFamily),
                'foreColor' => $this->foreColor,
                'sparkline' => $this->sparkline,
                'stacked' => $this->stacked,
            ],
            'plotOptions' => [
                'bar' => json_decode($this->horizontal),
            ],
            'colors' => json_decode($this->colors),
            'series' => json_decode($this->dataset),
            'dataLabels' => json_decode($this->dataLabels),
            'theme' => [
                'mode' => $this->theme
            ],
            'title' => [
                'text' => $this->title
            ],
            'subtitle' => [
                'text' => $this->subtitle,
                'align' => $this->subtitlePosition,
            ],
            'markers' => json_decode($this->markers),
            'legend' => [
                'show' => ($this->showLegend ? 'true' : 'false'),
            ],
        ];

        if ($this->labels !== []) {
            $options['labels'] = $this->labels;
        }

        if ($this->stroke !== '') {
            $options['stroke'] = json_decode($this->stroke);
        }

        if ($this->xAxisOption !== null && $this->xAxisOption->toArray() !== []) {
            $options['xaxis'] = $this->xAxisOption->toArray();
        }

        if ($this->yAxisOption !== null && $this->yAxisOption->toArray() !== []) {
            $options['yaxis'] = $this->yAxisOption->toArray();
        }

        if ($this->chartAnimationOption !== null) {
            $options['chart']['animations'] = $this->chartAnimationOption->toArray();
        }

        if ($this->gridOption !== null && $this->gridOption->toArray() !== []) {
            $options['grid'] = $this->gridOption->toArray();
        }

        if ($this->dropShadow !== '') {
            $options['chart']['dropShadow'] = json_decode($this->dropShadow);
        }

        return $options;
    }
}

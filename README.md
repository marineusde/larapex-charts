# Larapex Charts

<p align="center">

</p>

A Laravel wrapper for apex charts library.

## Why should I use a fork?

The maintainer of the original package is not really active. To many developers are waiting for a new release. I will try to keep this package up to date.

## Installation

Use composer.

```bash
composer require marineusde/larapex-charts
```

## Usage

### Basic example

In your controller add:

```php
$chart = (new LarapexChart)->setTitle('Posts')
                   ->setDataset([150, 120])
                   ->setLabels(['Published', 'No Published']);

```

Remember to import the Facade to your controller with 

```php
use marineusde\LarapexCharts\Facades\LarapexChart;
```

Or importing the LarapexChart class:

```php
use marineusde\LarapexCharts\LarapexChart;
```

Then in your view (Blade file) add: 

```php
 <!doctype html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport"
           content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Chart Sample</title>
 </head>
 <body>
 
     {!! $chart->container() !!}
 
     <script src="{{ $chart->cdn() }}"></script>
 
     {{ $chart->script() }}
 </body>
 </html>
```

### More complex example

```php
$chart = (new LarapexChart)->setType('area')
        ->setTitle('Total Users Monthly')
        ->setSubtitle('From January to March')
        ->setXAxis([
            'Jan', 'Feb', 'Mar'
        ])
        ->setDataset([
            [
                'name'  =>  'Active Users',
                'data'  =>  [250, 700, 1200]
            ]
        ]);
```

You can create a variety of charts including: Line, Area, Bar, Horizontal Bar, Heatmap, pie, donut and Radialbar.

## Contributing

The author is Henning Zimmermann.

## License
[MIT](./LICENSE.md)

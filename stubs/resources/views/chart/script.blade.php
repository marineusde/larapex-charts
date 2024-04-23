<?php
/** @var \marineusde\LarapexCharts\LarapexChart $chart */
?>
<script>
    var chart = new ApexCharts(document.querySelector("#{!! $chart->id !!}"), {!! $chart->toJsonEncodedString() !!});
    chart.render();
</script>

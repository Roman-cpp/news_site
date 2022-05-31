<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новости</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="/CSS/main_page_styles.css">
</head>
<body>
<div id="chart"></div>
<a href="/news">Новости</a>
<script>
    var options = {
        series: [{
            name: "Посещений",
            data: <?= json_encode($volumes);?>
        }],
        chart: {
            type: 'area',
            height: 300,
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },

        title: {
            text: 'Посещаемость сайта',
            align: 'left'
        },

        xaxis: {
            categories: <?= json_encode($dates);?>,
        },
        yaxis: {
            opposite: true
        },
        legend: {
            horizontalAlign: 'left'
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>

</body>
</html>
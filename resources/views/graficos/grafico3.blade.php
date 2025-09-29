@extends('layouts.admin')

@section('content')

<title>Gráficos Circulares</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<style>
  
    .chartContainer {
        width: 27cm; /* Ajusta el ancho */
        height: 25cm; /* Ajusta la altura */
        margin: -4cm; /* Centra el gráfico */
        margin-left: 7cm; /* Margen izquierdo de 15 cm */
   
    }
    .chart-title {
        text-align: center;
        font-size: 30px;
        font-weight: bold;
        color: #000; /* Color negro */

    }

</style>


<body>
    <div class="chart-title">TIPO DE REFORMAS</div>
<div id="chartsContainer">
    <div class="chartContainer">
        <canvas id="myPieChart"></canvas>
    </div>
</div>

<script>
    var data = @json($data['counts']);
    var labels = data.map(item => item.reforma);
    var values = data.map(item => item.total);
    var percentages = data.map(item => item.percentage.toFixed(2) + '%');

    var ctx = document.getElementById('myPieChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: [
                    '#FA3E99',
                    '#3282F6',
                    '#FFC90E',
                    '#4BC0C0',
                    '#9966FF',
                    '#FF9F40'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right', // Posición de las etiquetas
                    labels: {
                        font: {
                            size: 14, // Tamaño de la fuente de la leyenda
                        },
                        color: '#000' // Color negro para la leyenda
                    }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        let sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        let percentage = (value * 100 / sum).toFixed(1) + "%";
                        return `${value} (${percentage})`;
                    },
                    color: '#000', // Color negro para las letras
                    font: {
                        size: 16, // Tamaño de la fuente de los datos
                        weight: 'bold'
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });
</script>

@endsection


@extends('layouts.admin')

@section('content')

<title>Gráficos Circulares</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<style>
    #chartsContainer {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
    }
    .chartContainer {
        width: 410px; /* Ajusta el ancho */
        height: 410px; /* Ajusta la altura */
        margin: 0px; /* Espacio entre gráficos */
    }
    .chart-title {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        color: #000; /* Color negro */
    }
    .totalsContainer {
        display: flex;
        justify-content: space-around;
        margin-top: 10px; /* Ajusta el margen superior */
    }
    .total-box {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        color: #000; /* Color negro */
        margin: 5px; /* Ajusta el margen */
    }
</style>
</head>
<script src="https://d3js.org/d3.v7.min.js"></script>
<body>
<div class="chart-title">PROCESOS POR CUATRIMESTRES PARA EL AÑO 2025</div>
<div id="chartsContainer">
    <div class="chartContainer">
        <canvas id="myPieChart1"></canvas>
    </div>
    <div class="chartContainer">
        <canvas id="myPieChart2"></canvas>
    </div>
</div>
<div class="totalsContainer">
    <div class="total-box">
        <div>PAC INICIAL</div>
        <div>Número total de procesos: {{session('total') }}</div>
        <div>Precio total: ${{ number_format(session('precioTotal'), 2, '.', ',') }}</div>
    </div>
    <div class="total-box">
        <div>PAC CON REFORMAS</div>
        <div>Número total de procesos: {{session('total1') }}</div>
        <div>Precio total: ${{ number_format(session('precioTotal1'), 2, '.', ',') }}</div>
        
    </div>
</div>
<script>
    var ctx1 = document.getElementById('myPieChart1').getContext('2d');
    var myPieChart1 = new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: @json($cuatrimestres),
            datasets: [{
                data: @json($cantidades),
                backgroundColor: ['#FA3E99', '#3282F6', '#FFC90E'] // Colores pastel
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 16, // Tamaño de la fuente de la leyenda
                            weight: 'bold'
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

    var ctx2 = document.getElementById('myPieChart2').getContext('2d');
    var myPieChart2 = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: @json($cuatrimestres1),
            datasets: [{
                data: @json($cantidades1),
                backgroundColor: ['#FA3E99', '#3282F6', '#FFC90E'] // Colores pastel
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 16, // Tamaño de la fuente de la leyenda
                            weight: 'bold'
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
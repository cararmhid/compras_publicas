@extends('layouts.admin')

@section('content')

<title>Gráficos de Barras</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<link rel="stylesheet" href="path/to/your/css/file.css"> <!-- Mueve el CSS a un archivo separado -->

<div class="chart-title">TIPOS DE PROCESOS</div>
<style>
    .chart-container {
        flex: 1; /* Permite que los contenedores de los gráficos ocupen todo el espacio horizontal disponible */
        max-width: 1000%; /* Asegura que cada gráfico ocupe el 50% del ancho de la pantalla */
        height: 100%; /* Ajusta la altura según sea necesario */
        display: inline-block;
        margin: 20px;
    }
    .chart-title {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        color: #000; /* Color negro */
    }
    .charts-wrapper {
        display: flex;
        justify-content: space-between; /* Asegura que los gráficos estén uno al lado del otro */
        align-items: center;
        width: 100%;
    }
    .total-processes {
        text-align: center; /* Alinea el texto al centro */
        font-size: 20px;
        font-weight: bold;
        margin-top: 10px; /* Ajusta el margen superior para subir el texto */
        margin-left: 20px; /* Añade margen a la izquierda */
    }
    .total-processes span {
        display: inline-block;
        margin-right: 160px; /* Añade margen derecho para crear espacio entre los totales */
    }
</style>

<div class="charts-wrapper">
    <div class="chart-container">
        <div class="chart-title">Gráfico 1: Procesos Programados</div>
        <canvas id="myBarChart1"></canvas>
    </div>
  
    <div class="chart-container">
        <div class="chart-title">Gráfico 2: Procesos en Ejecución</div>
        <canvas id="myBarChart2"></canvas>
    </div>
</div>
<div class="total-processes">
    <span>Total de Procesos: {{ session('total') }}</span>
    <span>Total de Procesos: {{ session('total1') }}</span>
</div>

<script>
    var ctx1 = document.getElementById('myBarChart1').getContext('2d');
    var myBarChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: @json($procesos),
            datasets: [{
                data: @json($cantidades),
                backgroundColor: ['#FA3E99', '#3282F6', '#43992A', '#FFC90E'] // Colores pastel consistentes
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                datalabels: {
                    formatter: (value, ctx) => {
                    // Obtén el total de los valores
                    let sum = ctx.dataset.data.reduce((a, b) => a + b, 0);
                    // Calcula el porcentaje
                    let percentage = ((value / sum) * 100).toFixed(2);
                    return `${value}\n (${percentage}%)`; // Muestra el valor y el porcentaje
                    },
                    color: '#000', // Color negro para las letras
                    font: {
                        size: 14, // Tamaño de la fuente de los datos
                        weight: 'bold'

                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    // GRAFICO SEGUNDO
    var ctx2 = document.getElementById('myBarChart2').getContext('2d');
    var myBarChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: @json($procesos),
            datasets: [{
                data: @json($cantidades1),
                backgroundColor: ['#FFB6C1', '#B0E0E6', '#98FB98', '#FFFD55'] // Colores pastel diferentes
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                datalabels: {
                    formatter: (value, ctx) => {
                    // Obtén el total de los valores
                    let sum = ctx.dataset.data.reduce((a, b) => a + b, 0);
                    // Calcula el porcentaje
                    let percentage = ((value / sum) * 100).toFixed(2);
                    return `${value} \n(${percentage}%)`;  // Muestra el valor y el porcentaje
                    },
                    color: '#000', // Color negro para las letras
                    font: {
                        size: 14, // Tamaño de la fuente de los datos
                        weight: 'bold'
                        

                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });
</script>

@endsection

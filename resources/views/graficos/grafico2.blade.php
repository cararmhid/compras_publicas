@extends('layouts.admin')

@section('content')

<title>Gráficos de Barras</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> <!-- Agregar plugin de Data Labels -->

<div class="charts-wrapper-horizontal">
    <div class="chart-container">
        <h3><strong>Total de Procesos por Departamento</strong></h3>
        <canvas id="myHorizontalBarChart1"></canvas>
    </div>
    <div class="chart-container">
        <h3><strong>Procesos en Ejecución por Departamento</strong></h3>
        <canvas id="myHorizontalBarChart2"></canvas>
    </div>
</div>

<style>
    .charts-wrapper-horizontal {
        display: flex;
        flex-direction: column;
        align-items: center; /* Centrar los gráficos horizontalmente */
        width: 100%;
    }
    .chart-container {
        width: 100%; /* Ajustar el ancho para centrar los gráficos horizontalmente */
        height: 470px;
        margin: 40px; /* Agrega margen vertical entre los gráficos */
    }
    .chart-container h3 {
        text-align: center;
    }
</style>

<script>
    var colors = [
        'rgba(75, 192, 192, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',  
        'rgba(75, 192, 192, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',  
        'rgba(75, 192, 192, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
    ];

    var borderColors = [
        'rgba(75, 192, 192, 1)',
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
    ];

    var nombresDpto = @json(array_column($data['conteoProcesos']->toArray(), 'nombre_dpto'));

    // Calcular el total de todos los procesos
    var totalProcesos = @json(array_column($data['conteoProcesos']->toArray(), 'total_procesos')).reduce((a, b) => a + b, 0);

    var ctx1 = document.getElementById('myHorizontalBarChart1').getContext('2d');
    var myHorizontalBarChart1 = new Chart(ctx1, {
        type: 'bar', // Tipo de gráfico de barras horizontales
        data: {
            labels: @json(array_column($data['conteoProcesos']->toArray(), 'id_dpto')), // Labels: id_dpto
            datasets: [{
                label: 'Total de Procesos',
                data: @json(array_column($data['conteoProcesos']->toArray(), 'total_procesos')), // Data: total_procesos
                backgroundColor: colors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y', // Cambiar el eje de indexación a 'y' para barras horizontales
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                }
            },
            
            plugins: {
                datalabels: {
                    display: true,
                    align: 'right', // Posicionar etiquetas al final de la barra
                    anchor: 'right', // Asegurar que las etiquetas estén al final de la barra

                  formatter: (value, ctx) => {
                    // Obtén el total de los valores
                    let sum = ctx.dataset.data.reduce((a, b) => a + b, 0);
                    // Calcula el porcentaje                 
                    let percentage = ((value / sum) * 100).toFixed(2);
                    return `${value}      (${percentage}%)`;  // Muestra el valor y el porcentaje
                    }
                },  
                legend: {
                    display: true,
                    position: 'right', // Posición de la leyenda a la derecha
                    labels: {
                        generateLabels: function(chart) {
                            var data = chart.data;
                            var labels = data.labels.map(function(label, i) {
                                return {
                                    text: ' (' + label + ') ' + nombresDpto[i], // Nombre del departamento y ID en la leyenda
                                    fillStyle: data.datasets[0].backgroundColor[i],
                                    strokeStyle: data.datasets[0].borderColor[i],
                                    lineWidth: 1
                                };
                            });
                            // Agregar el total de todos los procesos a la leyenda
                            labels.push({
                                text: 'Total  (' + totalProcesos + ')',
                                fillStyle: 'rgba(0, 0, 0, 0)', // Sin color de fondo
                                strokeStyle: 'rgba(0, 0, 0, 0)', // Sin color de borde
                                lineWidth: 0
                            });
                            return labels;
                        }
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    var nombresDpto1 = @json(array_column($data['conteoProcesos1']->toArray(), 'nombre_dpto'));

    // Calcular el total de todos los procesos en el segundo gráfico
    var totalProcesos1 = @json(array_column($data['conteoProcesos1']->toArray(), 'total_procesos')).reduce((a, b) => a + b, 0);

    var ctx2 = document.getElementById('myHorizontalBarChart2').getContext('2d');
    var myHorizontalBarChart2 = new Chart(ctx2, {
        type: 'bar', // Tipo de gráfico de barras horizontales
        data: {
            labels: @json(array_column($data['conteoProcesos1']->toArray(), 'id_dpto')), // Labels: id_dpto
            datasets: [{
                label: 'Total de Procesos',
                data: @json(array_column($data['conteoProcesos1']->toArray(), 'total_procesos')), // Data: total_procesos
                backgroundColor: colors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y', // Cambiar el eje de indexación a 'y' para barras horizontales
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                }
            },
            plugins: {
                datalabels: {
                    display: true,
                    align: 'right', // Posicionar etiquetas al final de la barra
                    anchor: 'right', // Asegurar que las etiquetas estén al final de la barra
                    formatter: (value, ctx) => {
                    // Obtén el total de los valores
                    let sum = ctx.dataset.data.reduce((a, b) => a + b, 0);
                    // Calcula el porcentaje
                    let percentage = ((value / sum) * 100).toFixed(2);
                    return `${value}     (${percentage}%)`;  // Muestra el valor y el porcentaje
                    }
                },
                legend: {
                    display: true,
                    position: 'right', // Posición de la leyenda a la derecha
                    labels: {
                        generateLabels: function(chart) {
                            var data = chart.data;
                            var labels = data.labels.map(function(label, i) {
                                return {
                                    text:label + ' (' + nombresDpto1[i] + ')', // ID y nombre del departamento en la leyenda
                                    fillStyle: data.datasets[0].backgroundColor[i],
                                    strokeStyle: data.datasets[0].borderColor[i],
                                    lineWidth: 1
                                };
                            });
                            // Agregar el total de todos los procesos al segundo gráfico
                            labels.push({
                                text: 'Total (' + totalProcesos1 + ')',
                                fillStyle: 'rgba(0, 0, 0, 0)', // Sin color de fondo
                                strokeStyle: 'rgba(0, 0, 0, 0)', // Sin color de borde
                                lineWidth: 0
                            });
                            return labels;
                        }
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });
</script>

@endsection

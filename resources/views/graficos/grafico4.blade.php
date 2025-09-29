@extends('layouts.admin')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <style>
        .chart-title {
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .totals {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
    </style>
</head>
<body>
    <div class="chart-title">AHORROS DE PROCESOS EJECUTADOS POR DIRECCIONES</div>
    <div style="width: 75%; margin: auto;">
        <canvas id="myChart"></canvas>
        <div class="totals">
            <p>Total Precio Referencial: {{ number_format($data['totalPrecio'], 2) }}</p>
            <p>Total Precio Ejecutado: {{ number_format($data['totalPrecioEje'], 2) }}</p>
            <p>Total Ahorro: {{ number_format($data['totalDiferencia'], 2) }} ({{ number_format($data['totalPorcentajeAhorro'], 2) }}%)</p>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var data = @json($data);
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: data.datasets
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        formatter: function(value, context) {
                            if (context.dataset.label === 'Diferencia') {
                                var percentage = data.porcentajeAhorro[context.dataIndex];
                                return value.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' (' + percentage.toFixed(2) + '%)';
                            }
                            return value.toLocaleString(undefined, { minimumFractionDigits: 0, maximumFractionDigits: 2 });
                        },
                        color: 'black'
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>
</body>
@endsection

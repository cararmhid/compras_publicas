<div title="header">
    <img src="{{ public_path('storage/imagenes/logo_req.jpg') }}" alt="Logo" align="left" width="524" height="65" border="0"/>
</div>
<br/>
<br/>
<br/>
<p style="font-family: Impact, Charcoal, sans-serif; text-align: center;">
    REPORTE DE PROCESOS EN MORA
    <span style="font-family: Tahoma, Geneva, sans-serif; font-size: 12px; float: right;">
        <strong>Fecha:</strong> {{ date('d/m/Y') }}
    </span>
</p>

<table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
    <thead>
        <tr>
            <th style="width: 4%; border: 1px solid black; text-align: center; font-family: Tahoma, Geneva, sans-serif; font-size: 12px;"># Nec</th>
            <th style="width: 4%; border: 1px solid black; text-align: center; font-family: Tahoma, Geneva, sans-serif; font-size: 12px;"># Nec1</th>
            <th style="width: 10%; border: 1px solid black; text-align: center; font-family: Tahoma, Geneva, sans-serif; font-size: 12px;">Dpto</th>
            <th style="width: 9%; border: 1px solid black; text-align: center; font-family: Tahoma, Geneva, sans-serif; font-size: 12px;">Fec Ini</th>
            <th style="width: 9%; border: 1px solid black; text-align: center; font-family: Tahoma, Geneva, sans-serif; font-size: 12px;">Fec Fin</th>
            <th style="width: 13%; border: 1px solid black; text-align: center; font-family: Tahoma, Geneva, sans-serif; font-size: 12px;">Objeto del Proceso</th>
            <th style="width: 20%; border: 1px solid black; text-align: center; font-family: Tahoma, Geneva, sans-serif; font-size: 12px;">Observación</th>
            <th style="width: 21%; border: 1px solid black; text-align: center; font-family: Tahoma, Geneva, sans-serif; font-size: 12px;">Actividad a realizar</th>
            <th style="width: 5%; border: 1px solid black; text-align: center; font-family: Tahoma, Geneva, sans-serif; font-size: 12px;">Días de Mora</th>
            <th style="width: 5%; border: 1px solid black; text-align: center; font-family: Tahoma, Geneva, sans-serif; font-size: 12px;">Horas en mora</th>
        </tr>
    </thead>
    <tbody>
        @foreach($necesidades as $necesidad)
        <tr>
            <td style="text-align: center; border: 1px solid black; font-family: Tahoma, Geneva, sans-serif; font-size: 11px;">{{ $necesidad->nro_nec }}</td>
            <td style="text-align: center; border: 1px solid black; font-family: Tahoma, Geneva, sans-serif; font-size: 11px;">{{ $necesidad->nro_nec1 }}</td>
            <td style="text-align: center; border: 1px solid black; font-family: Tahoma, Geneva, sans-serif; font-size: 11px;">{{ $necesidad->dpto }}</td>
            <td style="text-align: center; border: 1px solid black; font-family: Tahoma, Geneva, sans-serif; font-size: 11px;">{{ $necesidad->fecha_ini }}</td>
            <td style="text-align: center; border: 1px solid black; font-family: Tahoma, Geneva, sans-serif; font-size: 11px;">{{ $necesidad->fecha_fin }}</td>
            <td style="text-align: center; border: 1px solid black; font-family: Tahoma, Geneva, sans-serif; font-size: 11px;">{{ $necesidad->descripcionn }}</td>
            <td style="text-align: center; border: 1px solid black; font-family: Tahoma, Geneva, sans-serif; font-size: 11px;">{{ $necesidad->observaciones }}</td>
            <td style="text-align: center; border: 1px solid black; font-family: Tahoma, Geneva, sans-serif; font-size: 11px;">{{ $necesidad->descripcion }}</td>
            <td style="text-align: center; border: 1px solid black; font-family: Tahoma, Geneva, sans-serif; font-size: 11px;">{{ $necesidad->dias_mora }}</td>
            <td style="text-align: center; border: 1px solid black; font-family: Tahoma, Geneva, sans-serif; font-size: 11px;">{{ $necesidad->horas_mora }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

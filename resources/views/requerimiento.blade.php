<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div title="header">
	<img src="{{ public_path('storage/imagenes/logo_req.jpg') }}" name="Imagen1" align="left" width="524" height="65" border="0"/>
</div>
<br/>
<br/>
<br/>

<table width="100%" cellpadding="2" cellspacing="0" style="background: transparent">
	<tr>
		<td colspan="3" width="100%" height="4" valign="top" style="border: none; padding: 0cm"><p align="center">
			<font color="#6d0c0c"><font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 11pt"><b>ORDEN
			DE REQUERIMIENTO</b></font></font></font></p>
		</td>
	</tr>
	<tr>
		<td width="48%" height="2" valign="top" style="border: none; padding: 0cm">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 10pt">Nro.
			de Requerimiento:</font></font>
		</td>
		<td width="26%" style="border: none; padding: 0cm">
			<font face="AnjaliOldLipi"><font size="1" style="font-size: 7pt">{{session('nro_necn')}}</font></font>
		</td>
	
	</tr>
	<tr style="background: transparent">
		<td width="48%" height="2" valign="top" style="border: none; padding: 0cm">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 10pt">Código
			del Área:</font></font>
		</td>
		<td width="26%" style="border: none; padding: 0cm">
            <font face="AnjaliOldLipi"><font size="1" style="font-size: 7pt">{{session('inic_direcc')}}{{session('sec_direcc')}}	</font></font>
		</td>
		<td rowspan="2" width="26%" valign="top" bgcolor="#d1c7c7" style="background: #d1c7c7; border: 1px solid #000000; padding: 0cm; text-align: center;">
			<font face="Annapurna SIL"><font size="1" style="font-size: 8pt"><i><b>Revisado</b></i></font></font>
			<br/><font face="Annapurna SIL"><font size="1" style="font-size: 8pt"><i><b>Compras
			Públicas continuar</b></i></font></font>
		</td>
	</tr>
	<tr style="background: transparent">
		<td width="48%" height="2" valign="top" style="border: none; padding: 0cm">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 10pt">Fecha
			de Orden:</font></font>
		</td>
		<td width="26%" style="border: none; padding: 0cm"><font face="AnjaliOldLipi"><font size="1" style="font-size: 7pt">{{session('fecha_ini')}}</font></font>
		</td>
	</tr>
	<tr style="background: transparent">
		<td width="48%" height="2" valign="top" style="border: none; padding: 0cm">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 10pt">Responsable:</font></font>
		</td>
		<td width="26%" style="border: none; padding: 0cm"><font face="AnjaliOldLipi"><font size="1" style="font-size: 7pt">{{session('responsable')}}</font></font>
		</td>
		<td width="26%" valign="top" style="border-top: none; border-bottom: none; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0cm 0.05cm">
			<br/>
		</td>
	</tr>

	<tr style="background: transparent">
		<td width="48%" height="2" valign="top" style="border: none; padding: 0cm">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 10pt">Área:</font></font>
		</td>
		<td width="26%" style="border: none; padding: 0cm"><font face="AnjaliOldLipi"><font size="1" style="font-size: 7pt">{{session('direcc')}}</font></font>
		</td>
		<td width="26%" valign="top" style="border-top: none; border-bottom: none; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0cm 0.05cm">
			<br/>

			
		</td>
	</tr>
	<tr style="background: transparent">
		<td width="48%" height="2" valign="top" style="border: none; padding: 0cm">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 10pt">Departamento:</font></font>
		</td>
		<td width="26%" style="border: none; padding: 0cm"><font face="AnjaliOldLipi"><font size="1" style="font-size: 7pt">{{session('dpto')}}</font></font>
		</td>
		<td width="26%" valign="top" style="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding-top: 0cm; padding-bottom: 0.05cm; padding-left: 0.05cm; padding-right: 0.05cm">
			<br/>

		</td>
	</tr>
	<tr>
		<td width="48%" height="2" valign="top" style="border: none; padding: 0cm">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 10pt">Cargo:</font></font>
		</td>
		<td width="26%" style="border: none; padding: 0cm"><font face="AnjaliOldLipi"><font size="1" style="font-size: 7pt">{{session('cargo_resp')}}</font></font>
		</td>
		<td width="26%" valign="top" style="border: none; padding: 0cm"><br/>

			
		</td>
	</tr>
	<tr>
		<td width="48%" height="2" valign="top" style="border: none; padding: 0cm">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 10pt">Programación
			del Pac:</font></font>
		</td>
		<td width="26%" style="border: none; padding: 0cm"><font face="AnjaliOldLipi"><font size="1" style="font-size: 7pt">{{session('cuatrimestre')}}</font></font>
		</td>
		<td width="26%" valign="top" style="border: none; padding: 0cm"><br/>

			
		</td>
	</tr>
	<tr>
		<td width="48%" height="2" valign="top" style="border: none; padding: 0cm">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 10pt">Normalizado:</font></font>
		</td>
		<td width="26%" style="border: none; padding: 0cm"><font face="AnjaliOldLipi"><font size="1" style="font-size: 7pt">{{session('normalizado')}}</font></font>
		</td>
		<td width="26%" valign="top" style="border: none; padding: 0cm"><br/>

		</td>
	</tr>
	<tr>
		<td width="48%" height="2" valign="top" style="border: none; padding: 0cm">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 10pt">Presupuesto
			Referencial:</font></font>
		</td>
		<td width="26%" style="border: none; padding: 0cm"><font face="AnjaliOldLipi"><font size="1" style="font-size: 7pt">{{session('precio_pac')}}</font></font>
		</td>
		<td width="26%" valign="top" style="border: none; padding: 0cm"><br/>

		</td>
	</tr>
	<tr>
		<td width="48%" height="2" valign="top" style="border: none; padding: 0cm">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 10pt">Procedimiento:</font></font>
		</td>
		<td width="26%" style="border: none; padding: 0cm"><font face="AnjaliOldLipi"><font size="1" style="font-size: 7pt">{{session('tip_proc')}}</font></font>
		</td>
		<td width="26%" valign="top" style="border: none; padding: 0cm"><br/>

		</td>
	</tr>
	<tr>
		<td width="48%" height="2" valign="top" style="border: none; padding: 0cm;">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 10pt">Sr.
			Director de Área de acuerdo al PAC solicito</font></font>
		</td>
		<td width="26%" style="border: none; padding: 0cm">
			<br/>

		</td>
		<td width="26%" valign="top" style="border: none; padding: 0cm; text-align: center">
			<font face="AnjaliOldLipi"><font size="1" style="font-size: 7pt">{{session('tip_comp')}}</font></font>
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="15%" height="5" style="border: none; padding: 0cm"><font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 10pt">A
			utilizarse en:</font></font>
		</td>
		<td rowspan="4" width="85%" style="border: none; padding-top: 0.2cm; text-align: justify">
			<font face="Droid Sans Fallback, sans-serif"><font size="1" style="font-size: 8pt">
          {{session('justific')}}</font></font>
		</td>
	</tr>
</table>

<table width="100%" cellpadding="2" cellspacing="0" style="background: transparent">
	<tr style="background: transparent">
		<td colspan="5" width="100%" valign="top" bgcolor="#d1c7c7" style="background: #d1c7c7; border: none; padding: 0cm; text-align: center">
			<font color="#6d0c0c"><font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 11pt"><b>OBJETO
			DEL CONTRATO</b></font></font></font>
		</td>
	</tr>
	<tr valign="top">
		<td width="12%" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.05cm; padding-bottom: 0.05cm; padding-left: 0.05cm; padding-right: 0cm; text-align: center">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 9pt">CODIGO</font></font>
		</td>
		<td width="47%" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.05cm; padding-bottom: 0.05cm; padding-left: 0.05cm; padding-right: 0cm; text-align: center">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 9pt">DESCRIPCION</font></font>
		</td>
		<td width="11%" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.05cm; padding-bottom: 0.05cm; padding-left: 0.05cm; padding-right: 0cm; text-align: center">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 9pt">UNIDAD</font></font>
		</td>
		<td width="12%" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.05cm; padding-bottom: 0.05cm; padding-left: 0.05cm; padding-right: 0cm; text-align: center">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 9pt">CANTIDAD</font></font>
		</td>
		<td width="18%" style="border: 1px solid #000000; padding: 0.05cm; text-align: center">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 9pt">ESPEC.
			TECNICAS</font></font>
		</td>
	</tr>
	<tr style="background: transparent">
		<td width="12%" valign="top" style="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0cm; padding-bottom: 0.05cm; padding-left: 0.05cm; padding-right: 0cm"><p align="center" style="margin-top: 0.1cm">
			<font face="AnjaliOldLipi"><font size="2" style="font-size: 8pt">{{session('cpc')}}</font></font></p>
		</td>
		<td width="47%" valign="top" style="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.1cm; padding-bottom: 0.05cm; padding-left: 0.1cm; padding-right: 0.1cm; text-align: justify">
			<font face="Droid Sans Fallback, sans-serif"><font size="1" style="font-size: 9pt">{{session('descripcion')}}</font></font>
		</td>
		<td width="11%" valign="bottom" style="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0cm; padding-bottom: 0.05cm; padding-left: 0.05cm; padding-right: 0cm"><p align="center" style="margin-top: 0.1cm">
        <font face="AnjaliOldLipi"><font size="2" style="font-size: 9pt">{{session('unidad')}}</font></font></p>
		</td>
		<td width="12%" valign="bottom" style="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0cm; padding-bottom: 0.05cm; padding-left: 0.05cm; padding-right: 0cm;"><p align="center" style="margin-top: 0.1cm">
        <font face="AnjaliOldLipi"><font size="2" style="font-size: 9pt">1.00</font></font></p>
		</td>
		<td width="18%" valign="bottom" style="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding-top: 0cm; padding-bottom: 0.05cm; padding-left: 0.05cm; padding-right: 0.05cm;"><p align="center" style="margin-top: 0.1cm">
        <font face="AnjaliOldLipi"><font size="2" style="font-size: 8pt">ANEXO</font></font></p>
		</td>
	</tr>
</table>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<p align="center" style="line-height: 100%; "><font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 9pt">_________________________<br/>
REQUIRENTE</font></font>
</p>
<br/>

<br/>

<br/>


<p align="center" style="line-height: 100%; "><font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 9pt">_________________________<br/>
DIRECTOR DE AREA</font></font>
</p>

<br/>
<br/>
<br/>
<br/>

<table width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="50%" style="border: none; padding: 0cm; text-align: center">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 9pt">_________________________</font></font>
		</td>
		<td width="50%" style="border: none; padding: 0cm; text-align: center">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 9pt">_________________________</font></font>
		</td>
	</tr>
	<tr valign="top">
		<td width="50%" style="border: none; padding: 0cm; text-align: center">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 9pt">DIRECTOR
			ADMINISTRATIVO</font></font>
		</td>
		<td width="50%" style="border: none; padding: 0cm; text-align: center">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 9pt">GERENTE
			GENERAL</font></font>
		</td>
	</tr>
</table>
</body>
</html>
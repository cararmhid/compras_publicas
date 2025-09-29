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
<br/>

<table width="100%" cellpadding="2" cellspacing="20" style="background: transparent">
	<tr>
		<td colspan="3" width="100%" height="4" valign="top" style="border: none; padding: 0cm"><p align="center">
			<font color="#6d0c0c"><font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 11pt"><b>CERTIFICACIÓN PAC</b></font></font></font></p>
		</td>
	</tr>
	<br/>

	<tr>
		<td width="100%" height="2" valign="top" style="border: none; padding: 0cm">
			<font face="Droid Sans Fallback, sans-serif"><font size="1" style="font-size: 10pt">Fecha:    </font></font>
	
			<font face="AnjaliOldLipi"><font size="1" style="font-size: 10pt">	{{now()}}</font></font>
		</td>
	
	</tr>
	<tr style="background: transparent">
		<td width="200%" height="2" valign="top" style="border: none; padding: 0cm">
			<font face="Droid Sans Fallback, sans-serif"><font size="1" style="font-size: 10pt">Objeto de Contratación:    </font></font>
	
            <font face="AnjaliOldLipi"><font size="1" style="font-size: 9pt">{{session('descripcion')}}</font></font>
		</td>
	
	</tr>
	
	<tr style="background: transparent">
		<td width="48%" height="2" valign="top" style="border: none; padding: 0cm">
			<font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 10pt">CPC:</font></font>
		
			<font face="AnjaliOldLipi"><font size="1" style="font-size: 10pt">{{session('cpc')}}</font></font>
		</td>
		<td width="26%" valign="top" style="border-top: none; border-bottom: none; border-eft: 0px solid #000000; border-right: 0px solid #000000; padding: 0cm 0.05cm">
			<br/>
		</td>
	</tr>
</table>

<table width="100%" cellpadding="4" cellspacing="10" style="page-break-inside: auto">
    <tr>
        <td width="100%" valign="top" style="background: transparent; border: 0px solid #000000; padding-left: 0.2cm; padding-right: 0.2cm; padding-top: 0cm; padding-bottom: 0cm">
            <p align="justify" style="font-style: normal; font-weight: normal; text-decoration: none">
                <font color="#000000"><font face="Liberation Serif, serif"><font size="8" style="font-size: 10pt"><span style="text-decoration: none">En cumplimiento a lo determinado en el artículo 43 del Reglamento de la Ley Orgánica del
                     Servicio Nacional de Contratación Pública - LOSNCP, en cuanto al requerimiento recibido, 
                     tengo a bien certificar que el objeto de contratación referente a {{session('descripcion')}}, SI consta en el Plan Anual de Contratación - PAC de la EMAPA-I del 
                     presente año; se remite el expediente a la Dirección Financiera con la finalidad de que se emita
                     la Certificación Presupuestaria correspondiente.</span></font></font></font>
            </p>
            <br/>
        </td>
    </tr>
</table>

<table width="100%" cellpadding="4" cellspacing="10">
	<tr valign="top">
		<br/>
		<br/>
		<br/>
		
		<td width="100%" height="20" style="border: none; padding: 0cm"><font face="Droid Sans Fallback, sans-serif"><font size="2" style="font-size: 10pt">
		 Atentamente;</font></font>
		 <br/>
		 <br/>
		 <br/>	
		 <br/>
		 <font face="Droid Sans Fallback, sans-serif"><font size="1" style="font-size: 10pt">
			Msc. Javier Villamil Acosta</font></font>
		 <br/>
		 <font face="Droid Sans Fallback, sans-serif"><font size="1" style="font-size: 10pt">
         Responsable de Contratación Pública</font></font>
		</td>
	</tr>
</table>

</body>
</html>
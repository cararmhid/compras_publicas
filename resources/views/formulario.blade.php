<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Certificación POA</title>
   
</head>
<body>

     <table width="100%" cellpadding="4" cellspacing="0" style="border: 1px solid #000000; "> 
      
        <tr> 
            <td width="34%" height="100" style="background: transparent; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.1cm; padding-bottom: 0.1cm; padding-left: 0.1cm; padding-right: 0cm"><img src="{{ public_path('storage/imagenes/logo_cert.jpg') }}" alt="AdminLTE Logo">
            </td> 
            <td weight="34%" style="background: transparent; border: 1px solid #000000; padding: 0.1cm; text-align: center;"> 
                PROCESO <br/> 
                Gestión de Planificación
            </td> 
            <td weight="32%" style="background: transparent; border: 1px solid #000000; padding: 0.1cm; text-align: center;">
                GERENCIA GENERAL <br/> 
               Unidad de Control de Gestión y Calidad 
            </td> 
        </tr> 
     
        <tr> 
            <td style="background: transparent; border: 1px solid #000000; padding: 0.1cm; text-align: center;" rowspan="2" width="34%" height="50"> 
               Código: GDCC-GP-Cer01 <br/> 
            </td> 
            <td style="background: transparent; border: 1px solid #000000; padding: 0.1cm; text-align: center;" rowspan="2" width="34%"> 
                Certificación POA 
            </td> 
            <td style="background: transparent; border: 1px solid #000000; padding: 0.1cm; text-align: center;" width="32%" > 
                Version: 02
            </td>
        </tr> 
        <tr >
            <td style="background: transparent; border: 1px solid #000000; padding: 0.1cm; text-align: center;" width="32%">
                            Fecha vigencia: 09-07-2024
            </td> 
        </tr> 
    </table>
    <br/>
    <p align="right" style="line-height: 100%; margin-bottom: 0cm">Fecha
    Ibarra:	{{now()}}</p>
    <br/>
    <p align="right" style="line-height: 100%; margin-bottom: 0cm">Nro.:
    000{{session('nro_cert_poa')}}	
    </p>
    <br/>
    <table width="100%" cellpadding="4" cellspacing="0" style="page-break-inside: auto">
	    <tr>
            <td width="100%" valign="top" style="background: transparent; border: 1px solid #000000; padding-left: 0.2cm; padding-right: 0.2cm; padding-top: 0cm; padding-bottom: 0cm">
                <p align="justify" style="font-style: normal; font-weight: normal; text-decoration: none">
                    <font color="#000000"><font face="Liberation Serif, serif"><font size="8" style="font-size: 10pt"><span style="text-decoration: none">Que la actividad que se pretende financiar con recursos de la EMAPA-I del proyecto de inversión {{ strtoupper(session('meta')) }}
                     de la Unidad de {{ strtoupper(session('dpto')) }} pertenece a la Dirección de {{ strtoupper(session('direcc')) }} SI CONSTA en
                    el Plan Operativo {{ date('Y') }}, el cual fue aprobado en el Directorio el
                    mes de diciembre de {{ date('Y')-1 }}, mismo que está anclado al presupuesto
                    {{ date('Y') }}, conforme lo previsto en el artículo 213 del COOTAD y
                    artículo 106 del Código Orgánico de Planificación y Finanzas
                    Públicas.</span></font></font></font>
                </p>
                <br/>
		    </td>
	    </tr>
    </table>

    <br/>

    <table width="100%" cellpadding="4" cellspacing="0" style="page-break-inside: avoid">
        <tr>
            <th class ="text-center" colspan="2" width="100%" valign="top" style="background: #729fcf; border: 1px solid #000000; padding: 0.1cm">DETALLE
            </th>
        </tr>
        <tr>
            <td width="25%" style="background: #729fcf; border: 1px solid #000000; padding: 0.1cm"><b>Dirección</b>
            </td>
            <td width="75%" style="background: #ffb66c; border: 1px solid #000000; padding: 0.1cm">{{ strtoupper(session('direcc')) }}
            </td>
        </tr>
        <tr>
            <td width="25%" style="background: #729fcf; border: 1px solid #000000; padding: 0.1cm"><b>Responsable</b>
            </td>
            <td width="75%" style="background: #ffb66c; border: 1px solid #000000; padding: 0.1cm">{{ strtoupper(session('responsable')) }}
            </td>
        </tr>
        <tr>
            <td width="25%" style="background: #729fcf; border: 1px solid #000000; padding: 0.1cm"><b>Unidad</b>
            </td>
            <td width="75%" style="background: #ffb66c; border: 1px solid #000000; padding: 0.1cm">{{ strtoupper(session('dpto')) }}
            </td>
        </tr>
        <tr>
            <td width="25%" style="background: #729fcf; border: 1px solid #000000; padding: 0.1cm"><b>Responsable</b>
            </td>
            <td width="75%" style="background: #ffb66c; border: 1px solid #000000; padding: 0.1cm">{{ strtoupper(session('responsable_uni')) }}
            </td>
        </tr>
        <tr>
            <td width="25%" style="background: #729fcf; border: 1px solid #000000; padding: 0.1cm"><b>Actividad</b>
            </td>
            <td width="75%" style="background: #ffb66c; border: 1px solid #000000; padding-left: 0.2cm; padding-right: 0.2cm; padding-top: 0cm; padding-bottom: 0.1cm"><p align="justify">{{ strtoupper(session('meta')) }}</p>
                <br/>
            </td>
        </tr>
        <tr>
            <td width="25%" style="background: #729fcf; border: 1px solid #000000; padding: 0.1cm"><b>Fecha Inicio</b>
            </td>
            <td width="75%" style="background: #ffb66c; border: 1px solid #000000; padding: 0.1cm">{{ session('fecha_ini') }}
            </td>
        </tr>
        <tr>
            <td width="25%" style="background: #729fcf; border: 1px solid #000000; padding: 0.1cm"><b>Fecha Final</b>
            </td>
            <td width="75%" style="background: #ffb66c; border: 1px solid #000000; padding: 0.1cm">{{ session('fecha_fin') }}
            </td>
        </tr>
        <tr>
            <td width="25%" style="background: #729fcf; border: 1px solid #000000; padding: 0.1cm"><b>Valor Asignado</b>
            </td>
            <td width="75%" style="background: #ffb66c; border: 1px solid #000000; padding: 0.1cm">{{ session('valor') }}
            </td>
        </tr>
    </table>

    <p style="line-height: 100%; margin-bottom: 0cm"><b>Nota: </b>El
    valor asignado para el cumplimiento de esta actividad incluye el
    Impuesto de Valor Agregado 15% (IVA).	</p>
    <br/>
    <br>
    <br>
    <br>
    
    <p align="center" style="line-height: 100%; margin-bottom: 0cm"><b>UNIDAD
    DE CONTROL DE CALIDAD Y GESTIÓN</b></p>

  
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\Necesidad;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\Style\Font;
use Illuminate\Support\Facades\Storage;


class DocumentoController extends Controller
{
    public function generarDocumento(Request $request)
    {
        // Crea una nueva instancia de PHPWord
        $phpWord = new PhpWord();

        // Agrega una nueva sección al documento
        $section = $phpWord->addSection();

        // Obtén datos de la base de datos
        $necesidads = Necesidad::all();
        $datos = Necesidad::where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->get();
        $direccions = Direccion::all();
        $fontStyleRed = ['color' => 'FF0000', 'size' => 10];
        $fontStyleBold = ['bold' => true, 'size' => 10];
  
        // Agrega una tabla al documento
        $table = $section->addTable();
        
        // Agrega texto al documento con la variable $descripcion
        $descripcion = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->value('descripcion');
        $justific = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->value('justific');
        $nro_nec=session('nro_necn');
        $responsable = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->value('responsable');
        $cuatrimestre = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->value('cuatrimestre');
        $tip_comp = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->value('tip_comp');
        $normalizado = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->value('normalizado');
        $precio_pac = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->value('precio_pac');
        $tip_proc = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->value('tip_proc');
        $forma_pago = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->value('forma_pago');
        $id_direcc = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->value('id_direcc');
        $dir_responsable = DB::table('direccions')->where('id', $id_direcc)->value('responsable');
     
     
        $section->addText("ASUNTO: INFORME DE LA DETERMINACIÓN DE LA NECESIDAD PARA $descripcion");
        $section->addTextBreak(1); // Salto de línea
        $section->addText("En cumplimiento con el Art 44 del Reglamento General de la LOSNC");
        $section->addTextBreak(1); // Salto de línea
        $section->addText("1. ANTECEDENTES",$fontStyleBold);
        $section->addTextBreak(1); // Salto de línea
        $section->addText("     1. LA EMAPA-I trabaja continuamente para brindar un servicio de calidad a la ciudadanía, con la aprobación de la Planificación Operativa Anual (POA) y Presupuesto aprobado por el Directorio de la institución.");
        $section->addText("     2. Se cuenta con el PAC aprobado por la Gerencia, correspondiente al presente ejercicio económico y publicado en la página del SERCOP de conformidad a la normativa legal.");
        $section->addText("     3. Los recursos públicos que se emplean en la ejecución de obras y en la adquisición de bienes y servicios incluidos los de consultoría sirven como elemento dinamizador de la economía local y nacional, identificando la capacidad ecuatoriana y promoviendo la generación de oferta competitiva.");
        $section->addText("     4. Describa la situación actual ¿Cuál o cuáles necesidades institucionales se pretenden satisfacer con la adquisición de ese bien y/o servicio u obra? Ejemplos: Actualmente, no existe, falta…..",$fontStyleRed);
        $section->addTextBreak(1); // Salto de línea
        $section->addText("2. JUSTIFICACIÓN",$fontStyleBold);
        $section->addTextBreak(1); // Salto de línea
        $section->addText("$justific");
        $section->addTextBreak(1); // Salto de línea
        $section->addText("3. OBJETO DE CONTRATACION",$fontStyleBold);
        $section->addTextBreak(1); // Salto de línea
        $section->addText("$descripcion");
        $section->addTextBreak(1); // Salto de línea
        $section->addText("4. DESCRIPCION DE LA CONTRATACION",$fontStyleBold);
        $section->addTextBreak(1); // Salto de línea



    // Crear tabla tipo grid (2 columnas)
    $table = $section->addTable();

    // Datos a mostrar
    $datos = [
        ['N° de requerimiento:', $nro_nec ?? ''],
        ['Responsable del Área:', $responsable ?? ''],
        ['Director del Área:', $dir_responsable ?? ''],
        ['Programación PAC:', $cuatrimestre ?? ''],
        ['Tipo:', $tip_comp ?? ''],
        ['Normalizado:', $normalizado ?? ''],
        ['Presupuesto Referencial:', $precio_pac ?? ''],
        ['Procedimiento:', $tip_proc ?? ''],
        ['Forma de Pago:', $forma_pago ?? ''],
        ['Plazo:', 'Nro de días de ejecución'],
    ];

    // Agregar filas a la tabla
    foreach ($datos as [$etiqueta, $valor]) {
        $row = $table->addRow();
        $row->addCell(2500)->addText($etiqueta);
        $row->addCell(4000)->addText($valor);
    }

     
 
        
        $section->addTextBreak(1); // Salto de línea
        $section->addText("5. CÁLCULO DE PRESUPUESTO REFERENCIAL",$fontStyleBold);
        $section->addTextBreak(1); // Salto de línea
        $section->addText("La determinación del presupuesto referencial para el presente procedimiento se realizó con base en el estudio de mercado que forma parte de este proceso, para tal efecto se tomó como referencia (procesos anteriores o proformas elegir según el caso)");
        $section->addTextBreak(1); // Salto de línea
        $section->addText("6. ANÁLISIS DE BENEFICIO, EFICIENCIA O EFECTIVIDAD",$fontStyleBold);
        $section->addTextBreak(1); // Salto de línea
        $section->addText("BENEFICIO: Qué beneficio va a obtener la entidad con la contratación y/o adquisición ...............................");
        $section->addTextBreak(1); // Salto de línea
     
        $section->addText("EFICIENCIA O EFECTIVIDAD: Un proyecto es más eficaz cuando logra sus resultados con el menor costo posible (lograr las metas con la menor cantidad de recursos) .........................");
        $section->addTextBreak(1); // Salto de línea


                    //// texto nuevo agregado
                // Texto en rojo
                    //$section->addText("7. IDENTIFICACIÓN DE LA NECESIDAD CON ENFOQUE SOSTENIBLE",$fontStyleBold);
                //  $section->addTextBreak(1); // Salto de línea
                //  $section->addText("En esta sección, el requirente deberá hacer constar uno o más CRITERIOS DE SOSTENIBILIDAD, con enfoque social, económico o ambiental que constan en la Guía para la aplicación de dichos criterios, ESTOS CRITERIOS DEBEN CONSTAR SOLO EN LOS SIGUIENTES PROCESOS:" ,$fontStyleRed);

                //  $section->addText("1. Procedimientos Dinámicos:", $fontStyleRed);
                // $section->addText("*  Subasta Inversa",$fontStyleRed);

                //  $section->addText("2. Procedimientos de Régimen Común:",$fontStyleRed);
                //  $section->addText("*  Menor cuantía",$fontStyleRed);
                //   $section->addText("*  Cotización",$fontStyleRed);
                //   $section->addText("*  Licitación",$fontStyleRed);
                //  $section->addTextBreak(1); // Salto de línea
                //  $section->addText("NOTA: Eliminar todo el texto que se encuentra con rojo",$fontStyleRed);
                    
                //   $section->addTextBreak(1); // Salto de línea
                    // fin de texto agregado
     
        $section->addText("8. CONCLUSIÓN",$fontStyleBold);
        $section->addTextBreak(1); // Salto de línea
     
        $section->addText("Para que la EMAPA-I pueda brindar un servicio ágil y oportuno se recomienda");
        $section->addTextBreak(1); // Salto de línea
     
        $section->addText("En virtud de lo analizado me permito determinar que es conveniente para la institución realizar $descripcion");
         $section->addTextBreak(1); // Salto de línea
     
        $section->addText("9. REQUERIMIENTO:",$fontStyleBold);
        $section->addTextBreak(1); // Salto de línea
     
        $section->addText("Sobre la base de los antecedentes expuestos, luego de la revisión y verificación de la documentación, solicito a usted, se gestione ante el Señor Gerente de la empresa, la autorización para iniciar con el procedimiento para la Adquisición / Contratación (elegir la que corresponda) $descripcion");
      
        // Guarda el documento en un archivo
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $fileName = 'documento_generado.docx';
        $objWriter->save($fileName);

        // Devuelve el archivo como respuesta para descargar y elimina el archivo después de enviarlo
        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
<?php


namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\Necesidad;
use Illuminate\Support\Facades\DB;



class MemodirController extends Controller
{
    public function generarMemodir(Request $request)
    {
        // Crea una nueva instancia de PHPWord
        $phpWord = new PhpWord();

        // Agrega una nueva sección al documento
        $section = $phpWord->addSection();

        // Obtén datos de la base de datos
        $necesidads = Necesidad::all();
        $datos = Necesidad::where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->get();
        $direccions = Direccion::all();

        
        // Agrega una tabla al documento
        $table = $section->addTable();
        
        // Agrega texto al documento con la variable $descripcion
        $cargo = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->value('cargo');
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
     
     
        $section->addText("De conformidad a lo solicitado por $cargo a través de Memorándum Nro. ______________, mediante la cual señala que: $justific, Luego de la revisión y verificación de la documentación, solicito autorice el inicio de proceso para $descripcion, para lo cual detallo la información correspondiente:");

        $section->addText("N° de requerimiento:       $nro_nec"); 
        $section->addText("Responsable del Área:      $responsable"); 
        $section->addText("Director del Área:         $dir_responsable"); 
        $section->addText(" Programación PAC:         $cuatrimestre");
        $section->addText("Tipo:                      $tip_comp"); 
        $section->addText("Normalizado:               $normalizado");
        $section->addText("Presupuesto Referencial:   $precio_pac");
        $section->addText("Procedimiento:             $tip_proc"); 
        $section->addText("Forma de Pago:             $forma_pago"); //Contra entrega 
        $section->addText("Plazo:                     ________"); 


             // Guarda el documento en un archivo
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $fileName = 'memo_direccion.docx';
        $objWriter->save($fileName);

        // Devuelve el archivo como respuesta para descargar y elimina el archivo después de enviarlo
        return response()->download($fileName)->deleteFileAfterSend(true);
    }

    public function generarMemodirpago(Request $request)
    {
        // Crea una nueva instancia de PHPWord
        $phpWord = new PhpWord();

        // Agrega una nueva sección al documento
        $section = $phpWord->addSection();

        // Obtén datos de la base de datos
        $necesidads = Necesidad::all();
        $datos = Necesidad::where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->get();
        $direccions = Direccion::all();

        
        // Agrega una tabla al documento
        $table = $section->addTable();
        
        // Agrega texto al documento con la variable $descripcion
        $cargo = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->value('cargo');
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
     
     
        $section->addText("Por medio del presente solicito gentilmente, autorice el pago a  (nombre  -----COMPLETO DE LA PERSONA O EMPRESA CONTRATISTA-----) con RUC N° xxxxxx, por el valor de: $ X.XXX,XX  (Valor más IVA) (EN CASOS DE QUE SEAN TARIFA 0, INDICAR : el bien o servicio (ESOGER) no grava IVA) por concepto de $descripcion correspondiente al  mes de xxxxx (si fuera el caso), en virtud de que los bienes o servicios (escoger) se han recibido a entera satisfacción, de conformidad a lo establecido en la Orden de Compra N° XXXX o Contrato  N° (escoger), para lo cual adjunto la documentación habilitante respectiva. ");


        $section->addText("1.-  N° de requerimiento:       $nro_nec"); 
        $section->addText("2.-  Proveedor:      "); 
        $section->addText("3.-  RUC:        "); 
        $section->addText("4.-  Valor a pagar:   ");
        $section->addText("5.-  Periodo: ");
        $section->addText("6.-  Nombre del Banco:"); 
        $section->addText("7.-  Normalizado:  ");
        $section->addText("8.-  Nro. de Cuenta:");
        $section->addText("9.-  Tipo de Cuenta:"); 
        $section->addText("10.- Email:"); //Contra entrega 
      

                // Guarda el documento en un archivo
                $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
                $fileName = 'Memo_para_pago.docx';
                $objWriter->save($fileName);
        
        // Devuelve el archivo como respuesta para descargar y elimina el archivo después de enviarlo
        return response()->download($fileName)->deleteFileAfterSend(true);
    }

}

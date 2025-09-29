<?php

namespace App\Http\Controllers;


use App\Models\Depar;
use App\Models\Direccion;
use App\Models\Flujo;
use App\Models\Necesidad;
use App\Models\Pac;
use App\Models\Poa;
use App\Models\Proceso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FlujoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $bot1 = $request->boton1;
    

        if ($bot1 == 7) {

            necesidad ::where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->update(['justific' => $request->justific]);
            necesidad ::where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->update(['forma_pago' => $request->forma_pago]);
           }
       $necesidads = Necesidad::all();
    
       $flujos = Flujo::where('nro_nec', session('nro_necn'))
                        ->where('nro_nec1', session('nro_nec1'))
                        ->where('estado', '>', 1)
                        ->get();

        return view('flujo.index', compact('necesidads', 'flujos'));
    }

    public function create()
    {
        //
    }

     public function store(Request $request)
    {
        //
    }

    public function show(string $id ,Request $request)
    {
   
        $flujos = Flujo::all();
        $necesidads = Necesidad::all();
        $procesos = Proceso::all();
        $pacs = Pac::findOrFail($id);
        $pacs->nro_nec = session('nro_necn');
        $pacs->save();
     
        
        if ($pacs->pc == "S" or $pacs->pc == "s" ) {
            $cuatrimestre = 'Primer Cuatrimestre';
        } else if ($pacs->sc == "S" or $pacs->sc == "s" ) {
            $cuatrimestre = 'Segundo Cuatrimestre';
        } else if ($pacs->tc == "S" or $pacs->tc == "s" ) {
            $cuatrimestre = 'Tercer Cuatrimestre';
        } else {
            $cuatrimestre = "Ninguno";
        }
        $id_proc = DB::table('pacs')->where('id', $id)->value('id_proceso');
        $proceso = DB::table('procesos')->where('id', $id_proc)->value('proceso');
        Necesidad::where('nro_nec', session('nro_necn'))->update(['cuatrimestre' => $cuatrimestre]);         
        Necesidad::where('nro_nec', session('nro_necn'))->update(['normalizado' => $pacs->normalizado]);
        Necesidad::where('nro_nec', session('nro_necn'))->update(['precio_pac' => $pacs->precio]);
        Necesidad::where('nro_nec', session('nro_necn'))->update(['tip_proc' => $proceso]);
         
       
        $necesidads = necesidad::where('nro_nec', session('nro_necn'))->get();
       
        
        return view('flujo.justifica', compact( 'pacs','flujos','necesidads'));

    }


    public function edit(string $id, Request $request)
    {
        $flujos = Flujo::findOrFail($id);
        $estado = $flujos->estado;
        $id_userf = $flujos->id_user;
        $id_user = auth()->user()->id;
        $formulario = $flujos->formulario;
        session(['fecha_ini' => $flujos->fecha_ini]);
        session(['nro_necn' => $flujos->nro_nec]);

           
        if ($estado == 2 && ($id_userf == $id_user) || ($id_user == '1')) {
          
            if ($formulario == 'form_siguiente') {
                return view('flujo.' . $formulario, ['flujos' => $flujos]);
            }

            if ($formulario == 'form_siguiente_nego') {
                return view('flujo.' . $formulario, ['flujos' => $flujos]);
            }

      if ($formulario == 'form_siguiente_error') {
                return view('flujo.' . $formulario, ['flujos' => $flujos]);
            }
            
           if ($formulario == 'form_mem_dir') {
                return view('flujo.' . $formulario, ['flujos' => $flujos]);
            }

            if ($formulario == 'form_informe') {
                return view('flujo.' . $formulario, ['flujos' => $flujos]);
            }
           

            if ($formulario == 'form_cert_pac') {
                $descripcion = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('descripcion');
                session(['descripcion' => $descripcion]);
                $cpc = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('cpc');
                session(['cpc' => $cpc]);

                $tip_proc = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('tip_proc');
                       
                if ($tip_proc == 'CATALOGO ELECTRONICO') {
                    session(['cat' => 'SI']);
                } else {
                    session(['cat' => 'NO']);
                }
                
                return view('flujo.' . $formulario, ['flujos' => $flujos]);
            }

          
            if ($formulario == 'form_certific_poa') {
                $direccions = Direccion::all();
                $poas = Poa::all();
                $id_poa = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('id_poa');
                $id_direcc = DB::table('poas')->where('id', $id_poa)->value('id_direcc');
                session(['responsable_uni' => DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('responsable')]);
                session(['responsable' => $responsable = DB::table('direccions')->where('id', $id_direcc)->value('responsable')]);
                $id_dpto = DB::table('poas')->where('id', $id_poa)->value('id_dpto');
                $nro_cert_poa = DB::table('necesidads')->max('nro_cert_poa') + 1;
                Necesidad::where('nro_nec', session('nro_necn'))->where('nro_cert_poa', null)->update(['nro_cert_poa' => $nro_cert_poa]);
                session([
                    'meta' => DB::table('poas')->where('id', $id_poa)->value('meta'),
                    'direcc' => DB::table('direccions')->where('id', $id_direcc)->value('direcc'),
                    'dpto' => DB::table('depars')->where('id', $id_dpto)->value('dpto'),
                    'fecha_ini' => DB::table('poas')->where('id', $id_poa)->value('fecha_ini'),
                    'fecha_fin' => DB::table('poas')->where('id', $id_poa)->value('fecha_fin'),
                    'valor' => DB::table('poas')->where('id', $id_poa)->value('valor'),
                    'nro_cert_poa' => DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('nro_cert_poa')
                ]);

                return view('flujo.' . $formulario, compact('flujos', 'poas'));
            }

            if ($formulario == 'form_requer') {
  
                $necesidads = Necesidad::all();
                $pacs = Pac::all();
                $id_dpto = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('id_dpto');
                $id_direcc = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('id_direcc');
                $pacs = Pac::where('id_dpto', $id_dpto)->get();
                $inic_dir = DB::table('direccions')->where('id', $id_direcc)->value('iniciales');
              
              // if ( $id_direcc < 1) {
                $sec_direcc = DB::table('necesidads')->where('id_direcc', $id_direcc)->max('sec_direcc') + 1;
           // }
                $cpc=db::table('pacs')->where('nro_nec', session('nro_necn'))->value('cpc');
                $descripcion=db::table('pacs')->where('nro_nec', session('nro_necn'))->value('descripcion');
                $unidad=db::table('pacs')->where('nro_nec', session('nro_necn'))->value('unidad');
                $cantidad=db::table('pacs')->where('nro_nec', session('nro_necn'))->value('cantidad');
                $id_pac=db::table('pacs')->where('nro_nec', session('nro_necn'))->value('id');
                session(['id_pac'=>$id_pac]);
              
               //if (($id_user <> '1')) {
                Necesidad::where('nro_nec', session('nro_necn'))->update(['inic_direcc' => $inic_dir]);
                Necesidad::where('nro_nec', session('nro_necn'))->update(['sec_direcc' => $sec_direcc]);
                Necesidad::where('nro_nec', session('nro_necn'))->update(['cargo' => auth()->user()->cargo]);
                Necesidad::where('nro_nec', session('nro_necn'))->update(['cpc' => $cpc]);
                Necesidad::where('nro_nec', session('nro_necn'))->update(['descripcion' => $descripcion]);
                Necesidad::where('nro_nec', session('nro_necn'))->update(['unidad' => $unidad]);
                Necesidad::where('nro_nec', session('nro_necn'))->update(['cantidad' => $cantidad]);
                Necesidad::where('nro_nec', session('nro_necn'))->update(['id_pac' => session('id_pac')]);
            
               // }



             
                $direcc = DB::table('direccions')->where('id', $id_direcc)->value('direcc');
                $responsable = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('responsable');
                $dpto = DB::table('depars')->where('id', $id_dpto)->value('dpto');
                $cargo=db::table('necesidads')->where('nro_nec', session('nro_necn'))->value('cargo');
                $cuatrimestre = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('cuatrimestre');
                $normalizado=db::table('pacs')->where('nro_nec', session('nro_necn'))->value('normalizado');
                $precio_pac=db::table('necesidads')->where('nro_nec', session('nro_necn'))->value('precio_pac');
                $tip_proc=db::table('necesidads')->where('nro_nec', session('nro_necn'))->value('tip_proc');
                $tip_comp = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('tip_comp');
                $justific = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('justific');
                $forma_pago= DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('forma_pago');
                $cpc = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('cpc');
                $descripcion = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('descripcion');
                $unidad = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('unidad');
                $cantidad = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('cantidad');
              
             
                session([
                    'inic_direcc' => DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('inic_direcc'),
                    'sec_direcc' => DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('sec_direcc'),
                    'fecha_nec' => DB::table('necesidads')->where('nro_nec', session('nro_necn'))->value('fecha_nec'),
                    'direcc' => $direcc,
                    'responsable' => $responsable,
                    'dpto' => $dpto,
                    'cargo_resp' => $cargo,
                    'cuatrimestre'=> $cuatrimestre,
                    'normalizado' => $normalizado,
                    'precio_pac' => $precio_pac,
                    'tip_proc' => $tip_proc,
                    'tip_comp' => $tip_comp,
                    'justific' => $justific,
                    'forma_pago' => $forma_pago,
                    'cpc' => $cpc,
                    'descripcion' => $descripcion,
                    'unidad' => $unidad,
                    'cantidad' => $cantidad,
                  
                ]);
                $options = ['Option 1', 'Option 2', 'Option 3'];
             
                if ($cpc != '') {
                    $pacs = Pac::where('nro_nec', session('nro_necn'))->get();
                }
              
               
                return view('flujo.' . $formulario, compact('flujos', 'pacs', 'necesidads', 'options',));
            }




        } else {
            return redirect()->route('flujos.index')->with('mensaje1', 'Permiso denegado');
        }

 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $pacs = Pac::all();
        $bot1 = $request->boton1;
        $obser = $request->observaciones;
        $flujos = Flujo::findOrFail($id);
        $orden1 = $flujos->orden;
        session(['obser' => $obser]);
     
        $negociacion = $request->negociacion;
     
        if ($negociacion == 'no') {
            $bot1=17;
        }
        $observ = $request->observacion;
        if ($observ == 'no') {
            $bot1=18;
        }

          $error = $request->error;
     
        if ($error == 'no') {
            $bot1=18;
        }

      //  dd($negociacion, $bot1);


        //REGRESAN EL TRAMITE
        if ($bot1 == 1) {
            $tiempo = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('orden', $orden1 - 1)->value('tiempo');
            $cod_user = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('orden', $orden1 - 1)->value('id_user');

            Flujo::where('nro_nec', session('nro_necn'))->where('orden', $orden1 - 1)->update([
                'estado' => 2,
                'observaciones' => $obser,
                'fecha_ini' => now(),
                'fecha_fin' => now()->addRealHour($tiempo)

            ]);
            Flujo::where('nro_nec', session('nro_necn'))->where('orden', $orden1)->update(['estado' => 4]);
            Necesidad::where('nro_nec', session('nro_necn'))->update(['cod_user' => $cod_user]);

        }

     // CONTINUA CON EL TRAMITE
if ($bot1 == 2) {

    $tiempo = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 1)->value('tiempo');
    $cod_user = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 1)->value('id_user');
    Flujo::where('nro_nec', session('nro_necn'))->where('orden', $orden1)->update(['estado' => 3]);
    Flujo::where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 1)->update([
        'estado' => 2,
        'fecha_ini' => now(),
        'fecha_fin' => now()->addRealHour($tiempo)
    ]);

    $dpto = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 1)->value('dpto');
    $tip_comp = DB::table('necesidads')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->value('tip_comp');

    if ($dpto == 'BODEGA' && $tip_comp == 'Servicios') {
        $tiempo = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 2)->value('tiempo');
        $cod_user = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 2)->value('id_user');
        Flujo::where('nro_nec', session('nro_necn'))->where('orden', $orden1+1)->update(['estado' => 3]);
        Flujo::where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 2)->update([
            'estado' => 2,
            'fecha_ini' => now(),
            'fecha_fin' => now()->addRealHour($tiempo)
        ]);
    }

    Necesidad::where('nro_nec', session('nro_necn'))->update(['cod_user' => $cod_user]);

    $flujos = Flujo::all();
    $necesidads = Necesidad::with(['poa'])->get();

    return view('necesidad.index', compact('necesidads', 'flujos'));
}


        if ($bot1 == 3) {
            return redirect()->route('generarPDF');
        }

        if ($bot1 == 4) {

                 necesidad ::where('nro_nec', session('nro_necn'))->update(['justific' => $request->justific]);
                 necesidad ::where('nro_nec', session('nro_necn'))->update(['forma_pago' => $request->forma_pago]);

          return redirect()->route('generar1PDF'); 
          // return redirect()->route('generarPDF');
        }

        if ($bot1 == 5) {

            $necesidads = Necesidad::all();
            $necesidads = Necesidad::where(['nro_nec' => session('nro_necn')])->where('nro_nec1', session('nro_nec1'))->get();
            session(['justific' => DB::table('necesidads')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->value('justific')]);
            session(['forma_pago' => DB::table('necesidads')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->value('forma_pago')]);
         
            return view('flujo.justifica', compact('flujos' ,'necesidads'));
        }

        if ($bot1 == 6) {
        
            return redirect()->route('generar-documento');
        }
        if ($bot1 == 7) {

         }

         if ($bot1 == 8) {
            return redirect()->route('generarMemodir');
        }
         
        if ($bot1 == 9) {
            return redirect()->route('generarCertPac');
        }
        
        if ($bot1 == 10) {
            return redirect()->route('generarCertCE');
        }
        
        if ($bot1 == 11) {
            return redirect()->route('downloadCC');
        }
        
        if ($bot1 == 12) {
            //obtienen el valor máximo
            $val_max = DB::table('necesidads')
            ->where('nro_nec', session('nro_necn'))           
            ->max('nro_nec1') + 1;
            
            // copia los registros
            $registros = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->get();

            foreach ($registros as $registro) {
                $nuevoRegistro = (array) $registro; // Convertir a array
            
                unset($nuevoRegistro['id']); // Eliminar el campo 'id' si es autoincremental
            
                $nuevoRegistro['nro_nec1'] = $val_max; // Asignar el nuevo valor a 'nro_nec1'
            
                DB::table('flujos')->insert($nuevoRegistro);
            }

            $necesidads = Necesidad::all();

            $originalRecord = necesidad::where('nro_nec', session('nro_necn'))
                ->where('nro_nec1', session('nro_nec1'))->first();
    
                $newRecord = $originalRecord->replicate();
                $newRecord->nro_nec1 = $val_max;
                $newRecord->save();

                $flujos = flujo::all();
                // $necesidads = Necesidad::with(['poa'])->get();
                 $necesidads = Necesidad::with(['poa'])->orderBy('nro_nec')->get();
               
                 return view('necesidad.index', compact('necesidads', 'flujos'));
           
        }
        
        if ($bot1 == 13) {
            return redirect()->route('downloadIS');
        }

        if ($bot1 == 14) {
            return redirect()->route('downloadAER');
        }

        if ($bot1 == 15) {
            return redirect()->route('generarMemodirpago');
        }

        if ($bot1 == 16) {
        
            if (!empty(session('obser'))) {
                //echo 'no está vacío';
                $tiempo = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 1)->value('tiempo');
                $cod_user = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 1)->value('id_user');
                Flujo::where('nro_nec', session('nro_necn'))->where('orden', $orden1)->update(['estado' => 3]);
                Flujo::where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 1)->update([
                    'estado' => 2,
                    'fecha_ini' => now(),
                    'fecha_fin' => now()->addRealHour($tiempo),
                    'observaciones' => session('obser')
                ]);
            } else {
                //echo 'vacío'  VA DIRECTO A PRESUPUESTO;
                $tiempo = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('orden', 11)->value('tiempo');
                $cod_user = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('orden', 11)->value('id_user');
                Flujo::where('nro_nec', session('nro_necn'))->where('orden', $orden1)->update(['estado' => 3]);
                Flujo::where('nro_nec', session('nro_necn'))->where('orden',11)->update([
                    'estado' => 2,
                    'fecha_ini' => now(),
                    'fecha_fin' => now()->addRealHour($tiempo)
                ]);
            
            }

            
            Necesidad::where('nro_nec', session('nro_necn'))->update(['cod_user' => $cod_user]);
            $flujos = flujo::all();
            $necesidads = Necesidad::with(['poa'])->get();
            
            return view('necesidad.index', compact('necesidads', 'flujos'));
        }

        if ($bot1 == 17) {

                $tiempo = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 3)->value('tiempo');
                $cod_user = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 3)->value('id_user');
                Flujo::where('nro_nec', session('nro_necn'))->where('orden', $orden1)->update(['estado' => 3]);
                Flujo::where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 3)->update([
                    'estado' => 2,
                    'fecha_ini' => now(),
                    'fecha_fin' => now()->addRealHour($tiempo)
                ]);
             
            Necesidad::where('nro_nec', session('nro_necn'))->update(['cod_user' => $cod_user]);
        
            $flujos = Flujo::all();
            $necesidads = Necesidad::with(['poa'])->get();
        
            return view('necesidad.index', compact('necesidads', 'flujos'));
        }

        if ($bot1 == 18) {

            $tiempo = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 2)->value('tiempo');
            $cod_user = DB::table('flujos')->where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 2)->value('id_user');
            Flujo::where('nro_nec', session('nro_necn'))->where('orden', $orden1)->update(['estado' => 3]);
            Flujo::where('nro_nec', session('nro_necn'))->where('orden', $orden1 + 2)->update([
                'estado' => 2,
                'fecha_ini' => now(),
                'fecha_fin' => now()->addRealHour($tiempo)
            ]);
         
        Necesidad::where('nro_nec', session('nro_necn'))->update(['cod_user' => $cod_user]);
    
        $flujos = Flujo::all();
        $necesidads = Necesidad::with(['poa'])->get();
    
        return view('necesidad.index', compact('necesidads', 'flujos'));
    }
        
        if ($bot1 == 0) {
        
  //          'observaciones' => session('obser');
            $obser = $request->observaciones;
            Flujo::where('nro_nec', session('nro_necn'))->where('orden', $orden1)->update(['observaciones' => $obser]);
            return redirect()->route('flujos.index');
        } else {
            return redirect()->route('flujos.index')->with('mensaje', 'Se registró el archivo de la manera correcta... ' . $bot1);
        }
        return redirect()->route('necesidads');
     

       }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function generarPDF(Request $request)
    {
       $data = ['campo1' => 'Valor 1', 'campo2' => 'Valor 2'];
        $pdf = Pdf::loadView('formulario', $data);
        return $pdf->download('Certificacion Poa.pdf');
      
    }

    public function generar1PDF(Request $request)
    {

        necesidad ::where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->update(['justific' => session('justific')]);
        necesidad ::where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->update(['forma_pago' => session('forma_pago')]);
   
        $data = ['campo1' => 'Valor 1', 'campo2' => 'Valor 2'];
        $pdf = Pdf::loadView('requerimiento', $data);
        return $pdf->download('Orden de Requerimiento.pdf');
    }
    
    public function generar2PDF(Request $request)
    {
     
        necesidad ::where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->update(['justific' => session('justific')]);
        necesidad ::where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->update(['forma_pago' => session('forma_pago')]);
 
        $data = ['campo1' => 'Valor 1', 'campo2' => 'Valor 2'];
        $pdf = Pdf::loadView('memorando', $data);
        return $pdf->download('Memo Requirente.pdf');
    }

    public function generarMemodir(Request $request)
    {
       $data = ['campo1' => 'Valor 1', 'campo2' => 'Valor 2'];
        $pdf = Pdf::loadView('formulario', $data);
        return $pdf->download('Memo Direccion.pdf');
      
    }

    public function generarCertPac(Request $request)
    {
       $data = ['campo1' => 'Valor 1', 'campo2' => 'Valor 2'];
        $pdf = Pdf::loadView('certificacion_pac', $data);
        return $pdf->download('Cartificación Pac.pdf');
      
    }

    public function generarCertCE(Request $request)
    {
       $data = ['campo1' => 'Valor 1', 'campo2' => 'Valor 2'];
        $pdf = Pdf::loadView('certificacion_ce', $data);
        return $pdf->download('Certificación Catálogo Electrónico.pdf');
      
    }

    public function downloadCC() {
        $fileName = 'CUADRO COMPARATIVO 2025 IC.xlsx';
        $filePath = 'formatos/' . $fileName;
    
        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()->back()->with('error', 'El archivo ' . $fileName . ' no existe.');
        }
    
        $file = Storage::disk('public')->path($filePath);
        return response()->download($file);
    }


    
//cambios en el ID del responsable para las infimas
public function asignar()
{
    $users = User::where('id_dpto', 29)->get();

    return view('flujo.editar', compact('users')); // Asegúrate de que 'editar' sea el nombre correcto de tu vista
}

public function guardar(Request $request)
{
    $userId = $request->input('user_id');
    //$nro_nec = $request->input('nro_nec'); // Asegúrate de que este campo esté en tu formulario

    flujo::where('nro_nec', session('nro_necn'))->where('dpto', 'CONTRATACIÓN PÚBLICA')->update(['id_user' => $userId]);
    necesidad::where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->update(['cod_user' => $userId]);
 
    return redirect()->route('flujos.index')->with('success', 'Datos guardados correctamente');
  
}


public function designar()
{
    $users = User::get();

    return view('flujo.editaradm', compact('users')); // Asegúrate de que 'editar' sea el nombre correcto de tu vista
}

public function guardaradm(Request $request)
{
    $userId = $request->input('user_id');
    //$nro_nec = $request->input('nro_nec'); // Asegúrate de que este campo esté en tu formulario

    flujo::where('nro_nec', session('nro_necn'))->where('dpto', 'ADMINISTRADOR')->update(['id_user' => $userId]);
    necesidad::where('nro_nec', session('nro_necn'))->where('nro_nec1', session('nro_nec1'))->update(['cod_user' => $userId]);
   
    return redirect()->route('flujos.index')->with('success', 'Datos guardados correctamente');
  
}

public function downloadIS() {
    $fileName = 'INFORM_SATISFACCION.docx';
    $filePath = 'formatos/' . $fileName;

    if (!Storage::disk('public')->exists($filePath)) {
        return redirect()->back()->with('error', 'El archivo ' . $fileName . ' no existe.');
    }

    $file = Storage::disk('public')->path($filePath);
    return response()->download($file);
}

public function downloadAER(Request $request)
{
    $tipo = strtolower($request->input('tipoActa'));

    
    switch ($tipo) {
        case 'bienes':
            $fileName = 'ACTA ENTREGA RECEPCION BIENES.doc';
            break;
        case 'servicios':
            $fileName = 'ACTA ENTREGA RECEPCION SERVICIOS.doc';
            break;
        case 'consultoria':
            $fileName = 'ACTA ENTREGA RECEPCION CONSULTORIA.doc';
            break;
        case 'obras':
            $fileName = 'ACTA ENTREGA RECEPCION OBRAS.doc';
            break;
        default:
            return back()->with('error', 'Tipo de acta no reconocido.');
    }

    //$fileName = 'ACTA ENTREGA RECEPCION BIENES.doc';
    $filePath = 'formatos/' . $fileName;

    if (!Storage::disk('public')->exists($filePath)) {
        return redirect()->back()->with('error', 'El archivo ' . $fileName . ' no existe.');
    }

    $file = Storage::disk('public')->path($filePath);
    return response()->download($file);
}
}

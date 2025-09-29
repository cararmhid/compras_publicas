<?php

namespace App\Http\Controllers;

use App\Models\Necesidad;
use App\Models\Poa;
use App\Models\Direccion;
use App\Models\Flujo1;
use App\Models\Flujo2;
use App\Models\Flujo3;
use App\Models\Flujo4;
use App\Models\Flujo;
use App\Models\flujo5;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\Configuration\Php;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
     // $direccions = Direccion::all();
    
      $id_dptou=auth()->user()->id_dpto;
      $necesidads = Necesidad::all();
      $poas = Poa::all();
      $poas = poa::where('id_dpto', $id_dptou)->get();
     
        return view('solicitud.index', compact('poas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (Request $request)
    {
      
     //

        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $poas = Poa::findOrFail($id);
        $necesidads = Necesidad::all();
      
        $options = [
             'value1' => 'Bien',
            'value2' => 'Obras',
            'value3' => 'Consultoría',
            'value4' => 'Servicios'
        ];
        $presups = [
            'value1' => 'Infima Cuantía',
            'value2' => 'Catálogo Electrónico',
            'value3' => 'Común',
            'value4' => 'Especial',
            'value5' => 'VPN',
        ];
       
        return view('solicitud.edit', compact('poas', 'necesidads', 'presups', 'options', ));
      
    }

    
    public function update(Request $request, string $id)
    {
        $poa = Poa::findOrFail($id);
        $id_poa = $poa->id;
       
        $necesidads = Necesidad::all();

        $nro_necn = DB::table('necesidads')->max('nro_nec') + 1;
       
      
        $id_direcc = DB::table('poas')->where('id', $id)->value('id_direcc');
      
        $id_dpto = DB::table('poas')->where('id', $id)->value('id_dpto');
         
        $id_userdir = direccion::where('id', $id_direcc = auth()->user()->id_direcc)->value('id_user');
       
                //inserta en la tabla flujos las tablas flujo1, flujo2....
      if ($request->tipo_flujo == 'Infima Cuantía')
      {
        // reemplaza id_user de acuerdo al Requirente y Dir de Area
        flujo1::where('dpto', '=', 'Requirente')->update(['id_user' => $id = auth()->user()->id]);
        flujo1::where('dpto', '=', 'Dirección Requirente')->update(['id_user' => $id_userdir]);
        flujo1::where('id', '<', 1000)->update(['nro_nec' => $nro_necn]);
        $tiempo = DB::table('flujo1s')->where('nro_nec',$nro_necn)->where('orden', '=', 1)->value('tiempo');
        // Insertar todos los registros de flujoTable en flujo_general
        $flujoTable = Flujo1::all();
      }
      if ($request->tipo_flujo == 'Catálogo Electrónico')
      {
        // reemplaza id_user de acuerdo al Requirente y Dir de Area
        flujo2::where('dpto', '=', 'Requirente')->update(['id_user' => $id = auth()->user()->id]);
        flujo2::where('dpto', '=', 'Dirección Requirente')->update(['id_user' => $id_userdir]);
        flujo2::where('id', '<', 1000)->update(['nro_nec' => $nro_necn]);
        $tiempo = DB::table('flujo2s')->where('nro_nec',$nro_necn)->where('orden', '=', 1)->value('tiempo');
        // Insertar todos los registros de flujoTable en flujo_general
        $flujoTable = Flujo2::all();
      }
      if ($request->tipo_flujo == 'Común')
      {
        // reemplaza id_user de acuerdo al Requirente y Dir de Area
        Flujo3::where('dpto', '=', 'Requirente')->update(['id_user' => $id = auth()->user()->id]);
        flujo3::where('dpto', '=', 'Dirección Requirente')->update(['id_user' => $id_userdir]);
        flujo3::where('id', '<', 1000)->update(['nro_nec' => $nro_necn]);
        $tiempo = DB::table('flujo3s')->where('nro_nec',$nro_necn)->where('orden', '=', 1)->value('tiempo');
        // Insertar todos los registros de flujoTable en flujo_general
        $flujoTable = Flujo3::all();
      }
      if ($request->tipo_flujo == 'Especial')
      {
        // reemplaza id_user de acuerdo al Requirente y Dir de Area
        flujo4::where('dpto', '=', 'Requirente')->update(['id_user' => $id = auth()->user()->id]);
        flujo4::where('dpto', '=', 'Dirección Requirente')->update(['id_user' => $id_userdir]);
        flujo4::where('id', '<', 1000)->update(['nro_nec' => $nro_necn]);
        $tiempo = DB::table('flujo4s')->where('nro_nec',$nro_necn)->where('orden', '=', 1)->value('tiempo');
        // Insertar todos los registros de flujoTable en flujo_general
        $flujoTable = Flujo4::all();
      }
      if ($request->tipo_flujo == 'VPN')
      {
        // reemplaza id_user de acuerdo al Requirente y Dir de Area
        flujo5::where('dpto', '=', 'Requirente')->update(['id_user' => $id = auth()->user()->id]);
        flujo5::where('dpto', '=', 'Dirección Requirente')->update(['id_user' => $id_userdir]);
        flujo5::where('id', '<', 1000)->update(['nro_nec' => $nro_necn]);
        $tiempo = DB::table('flujo5s')->where('nro_nec',$nro_necn)->where('orden', '=', 1)->value('tiempo');
        // Insertar todos los registros de flujoTable en flujo_general
        $flujoTable = Flujo5::all();
      }

//************************************
        foreach ($flujoTable as $index => $flujog) {
           $flujo = new Flujo();
          
            // Copiar campos de las tablas de flujo1, flujo2,....
          $flujo->nro_nec = $nro_necn;
          $flujo->orden = $flujog->orden;
          $flujo->dpto = $flujog->dpto;
          $flujo->descripcion = $flujog->descripcion;
          $flujo->id_user = $flujog->id_user;
          $flujo->tiempo = $flujog->tiempo;
          $flujo->formulario = $flujog->formulario;
          $flujo->estado = 1;
          $flujo->save();
          flujo::where('nro_nec',$nro_necn)->where('orden', '=', 1)->update(['fecha_ini' => $request->datetime.now()]);
          flujo::where('nro_nec',$nro_necn)->where('orden', '=', 1)->update(['fecha_fin' => $request->datetime.now()->addRealHour($tiempo)]);
          flujo::where('nro_nec',$nro_necn)->where('orden', '=', 2)->update(['fecha_ini' => $request->datetime.now()->addRealHour($tiempo)]);
          flujo::where('nro_nec',$nro_necn)->where('orden', '=', 2)->update(['fecha_fin' => $request->datetime.now()->addRealHour($tiempo)]);
          flujo::where('nro_nec',$nro_necn)->where('orden', '=', 1)->update(['estado' => 2]);
          flujo::where('nro_nec',$nro_necn)->where('orden', '=', 2)->update(['estado' => 1]);

          if ($request-> tip_comp == 'Servicios')
          {
            $flujo::where('nro_nec',$nro_necn)->where('orden', '=', 3)->update(['fecha_ini' => $request->datetime.now()->addRealHour($tiempo)]);
            $flujo::where('nro_nec',$nro_necn)->where('orden', '=', 3)->update(['fecha_fin' => $request->datetime.now()->addRealHour($tiempo)]);
            $flujo::where('nro_nec',$nro_necn)->where('orden', '=', 1)->update(['estado' => 3]);
            $flujo::where('nro_nec',$nro_necn)->where('orden', '=', 2)->update(['estado' => 2]);

          }
        
} 
        //crea registro en la Tabla Necesidad
        $necesidads = Necesidad::all();
        $necesidad = new Necesidad();
        $necesidad->nro_nec = $nro_necn;
        $necesidad->id_direcc = $id_direcc;
        $necesidad->id_dpto = $id_dpto;
        $necesidad->tip_comp = $request->tip_comp;
        $necesidad->tipo_flujo = $request->tipo_flujo;
        $necesidad->fecha_nec = $request->datetime.now();
        $necesidad->id_poa = $id_poa;
        if ($request-> tip_comp == 'Servicios')
        {
//           $necesidad->cod_user = 64; 
        }else {
           $necesidad->cod_user = 12; 
        }
         $necesidad->id_user = auth()->user()->id;
        $necesidad->responsable = auth()->user()->name;
             
        $necesidad->save();

        $necesidads = Necesidad::all();
        return view('necesidad.index', compact('necesidads'));
    }
 
    public function destroy(string $id)
    {
        //
    }
}

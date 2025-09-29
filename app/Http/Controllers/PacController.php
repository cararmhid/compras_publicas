<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pac;
use App\Models\Depar;
use App\Models\Proceso;

class PacController extends Controller
{
    // Método para mostrar la lista de Pacs
    public function index()
    {
        $pacs = Pac::with(['proceso', 'depar'])->get();

        return view('pac.index', compact('pacs'));

        //return view('pacs.index', compact('pacs, direccions, depars'));
    }

    // Método para mostrar el formulario de creación de un PAC
    public function create()
    {

        $procesos = Proceso::all();
        $depars = Depar::all();
        $options = [
            'value1' => 'Bien',
            'value2' => 'Obras',
            'value3' => 'Consultoría',
            'value4' => 'Servicios'
        ];
        $presups = [
            'value1' => 'Gasto Corriente',
            'value2' => 'Proyecto de Inversión',
        ];
        $regims = [
            'value1' => 'Común',
            'value2' => 'Especial',
        ];
        $reformas = [
            'value1' => 'CAMBIO DE PRESUPUESTO',
            'value2' => 'CAMBIO DE CUATRIMESTRE',
            'value3' => 'CAMBIO DE PROCEDIMIENTO',
            'value5' => 'CAMBIO DE CPC',
            'value6' => 'CAMBIO CANTIDAD Y PRESUPUESTO',
            'value7' => 'CAMBIO OBJETO Y CUATRIMESTRE',
            'value8' => 'CAMBIO CANTIDAD PRESUPUESTO Y CUATRIMESTRE',
            'value9' => 'CAMBIO DE PRESUPUESTO Y CUATRIMESTRE',
            'value10' => 'CAMBIO PRESUPUESTO CUATRIMESTRE Y PROCEDIMIENTO',
            'value11' => 'CAMBIO DE CUATRIMESTRE Y MONTO',
            'value12' => 'CAMBIO DE MONTO',
            'value13' => 'CAMBIO PARTIDA',
            'value14' => 'CAMBIO DESCRIPCION MONTO Y CUATRIMESTRE',
            'value15' => 'CAMBIO DESCRIPCION PROCESO',
            'value16' => 'CREACION NUEVO PROCESO',
            'value17' => 'CAMBIO PRESUPUESTO Y CUATRIMESTRE',
            'value18' => 'CAMBIO PROCEDIMIENTO Y CUATRIMESTRE',
            'value19' => 'CAMBIO PROCEDIMIENTO Y MONTO',
            'value20' => 'CAMBIO PROCEDIMIENTO, CUATRIMESTRE Y MONTO',
            'value21' => 'CAMBIO DE PARTIDA Y CUATRIMESTRE',
            'value22' => 'CAMBIO DE PARTIDA,Y MONTO',
            'value23' => 'CAMBIO DE PARTIDA Y DESCRIPCION',
            'value24' => 'CAMBIO DE PARTIDA,PROCEDIMIENTO Y CUATRIMESTRE',
            'value25' => 'CAMBIO DE PARTIDA, PROCEDIMIENTO Y MONTO',
            'value26' => 'CAMBIO DE PARTIDA, PROCEDIMIENTO, CUATRIMESTRE Y MONTO',
            'value27' => 'CAMBIO DE PARTIDA, DESCRIPCION, CUATRIMESTRE Y MONTO',
            'value28' => 'CAMBIO DE PARTIDA, DESCRIPCION, PROCEDIMIENTO Y CUATRIMESTRE',
            'value29' => 'CAMBIO DE PARTIDA, DESCRIPCION, PROCEDIMIENTO Y MONTO',
            'value30' => 'CAMBIO DE PARTIDA, DESCRIPCION, PROCEDIMIENTO, CUATRIMESTRE Y MONTO',
            'value31' => 'CAMBIO DE PARTIDA, DESCRIPCION, PROCEDIMIENTO, CUATRIMESTRE',
        ];


        return view('pac.create', compact('procesos', 'depars', 'presups', 'options', 'regims','reformas'));
    }

    // Método para almacenar un nuevo PAC
    public function store(Request $request)
    {
        $request->validate([
            'año' => 'required',
            'partida' => 'required',
            'cpc' => 'required',
            'tip_comp' => 'required',
            'descripcion' => 'required',
            'cantidad' => 'required',
            'unidad' => 'required',
            'precio' => 'required',
          //  'pc' => 'required',
          //  'sc' => 'required',
          //  'tc' => 'required',
            'normalizado' => 'required',
            'catalogo' => 'required',
            'id_proceso' => 'required',
            'fondo' => 'required',
            'regimen' => 'required',
            'tipo_presupuesto' => 'required',
            'id_dpto' => 'required',
            'nro_reforma' => 'required',
            'reforma' => 'required',
        ]);
        
        $pacs = new pac();

        $pacs->año = $request->año;
        $pacs->partida = $request->partida;
        $pacs->cpc = $request->cpc;
        $pacs->tip_comp = $request->tip_comp;
        $pacs->descripcion = $request->descripcion;
        $pacs->cantidad = $request->cantidad;
        $pacs->unidad = $request->unidad;
        $pacs->precio = $request->precio;
        $pacs->pc = $request->pc;
        $pacs->sc = $request->sc;
        $pacs->tc = $request->tc;
        $pacs->normalizado = $request->normalizado;
        $pacs->catalogo = $request->catalogo;
        $pacs->id_proceso = $request->id_proceso;
        $pacs->fondo = $request->fondo;
        $pacs->regimen = $request->regimen;
        $pacs->tipo_presupuesto = $request->tipo_presupuesto;
        $pacs->id_dpto = $request->id_dpto;
        $pacs->nro_reforma = $request->nro_reforma;
        $pacs->reforma = $request->reforma;
        
        $pacs->save();

        return redirect()->route('pacs.index')
            ->with('mensaje', 'El PAC se ha creado correctamente')
            ->with('icono', 'success');
    }

    // Método para mostrar el formulario de edición de un PAC
    public function edit($id)
    {
        $procesos = Proceso::all();
        $depars = Depar::all();
        $options = [
            'value1' => 'BIEN',
            'value2' => 'OBRAS',
            'value3' => 'CONSULTORIA',
            'value4' => 'SERVICIO'
        ];
        $presups = [
            'value1' => 'GASTO CORRIENTE',
            'value2' => 'PROYECTO DE INVERSION',
        ];
        $regims = [
            'value1' => 'COMUN',
            'value2' => 'ESPECIAL',
        ];

        $reforms = [
            'value0' => ' ',
            'value1' => 'CAMBIO DE PRESUPUESTO',
            'value2' => 'CAMBIO DE CUATRIMESTRE',
            'value3' => 'CAMBIO DE PROCEDIMIENTO',
            'value5' => 'CAMBIO DE CPC',
            'value6' => 'CAMBIO CANTIDAD Y PRESUPUESTO',
            'value7' => 'CAMBIO OBJETO Y CUATRIMESTRE',
            'value8' => 'CAMBIO CANTIDAD PRESUPUESTO Y CUATRIMESTRE',
            'value9' => 'CAMBIO DE PRESUPUESTO Y CUATRIMESTRE',
            'value10' => 'CAMBIO PRESUPUESTO CUATRIMESTRE Y PROCEDIMIENTO',
            'value11' => 'CAMBIO DE CUATRIMESTRE Y MONTO',
            'value12' => 'CAMBIO DE MONTO',
            'value13' => 'CAMBIO PARTIDA',
            'value14' => 'CAMBIO DESCRIPCION MONTO Y CUATRIMESTRE',
            'value15' => 'CAMBIO DESCRIPCION PROCESO',
            'value16' => 'CREACION NUEVO PROCESO',
            'value17' => 'CAMBIO PRESUPUESTO Y CUATRIMESTRE',
            'value18' => 'CAMBIO PROCEDIMIENTO Y CUATRIMESTRE',
            'value19' => 'CAMBIO PROCEDIMIENTO Y MONTO',
            'value20' => 'CAMBIO PROCEDIMIENTO, CUATRIMESTRE Y MONTO',
            'value21' => 'CAMBIO DE PARTIDA Y CUATRIMESTRE',
            'value22' => 'CAMBIO DE PARTIDA,Y MONTO',
            'value23' => 'CAMBIO DE PARTIDA Y DESCRIPCION',
            'value24' => 'CAMBIO DE PARTIDA,PROCEDIMIENTO Y CUATRIMESTRE',
            'value25' => 'CAMBIO DE PARTIDA, PROCEDIMIENTO Y MONTO',
            'value26' => 'CAMBIO DE PARTIDA, PROCEDIMIENTO, CUATRIMESTRE Y MONTO',
            'value27' => 'CAMBIO DE PARTIDA, DESCRIPCION, CUATRIMESTRE Y MONTO',
            'value28' => 'CAMBIO DE PARTIDA, DESCRIPCION, PROCEDIMIENTO Y CUATRIMESTRE',
            'value29' => 'CAMBIO DE PARTIDA, DESCRIPCION, PROCEDIMIENTO Y MONTO',
            'value30' => 'CAMBIO DE PARTIDA, DESCRIPCION, PROCEDIMIENTO, CUATRIMESTRE Y MONTO',
            'value31' => 'CAMBIO DE PARTIDA, DESCRIPCION, PROCEDIMIENTO, CUATRIMESTRE',
        ];

        $pac = Pac::findOrFail($id);

        return view('pac.edit', compact('procesos', 'depars', 'presups', 'options', 'regims','pac','reforms'));
    }

    // Método para actualizar un PAC
    public function update(Request $request, $id)
    {
        $request->validate([
            'año' => 'required',
            'partida' => 'required',
            'cpc' => 'required',
            'tip_comp' => 'required',
            'descripcion' => 'required',
            'cantidad' => 'required',
            'unidad' => 'required',
            'precio' => 'required',
         //   'pc' => 'required',
         //   'sc' => 'required',
         //   'tc' => 'required',
            'normalizado' => 'required',
            'catalogo' => 'required',
            'id_proceso' => 'required',
            'fondo' => 'required',
            'regimen' => 'required',
            'tipo_presupuesto' => 'required',
            'id_dpto' => 'required',
          //  'nro_reforma' => 'required',
          //  'reforma' => 'required',
        ]);

        $pac = Pac::findOrFail($id);      
        $pac->update($request->all());
        pac::where('id', $id)->update(['reforma' => request('reforma')]);

        return redirect()->route('pacs.index')
            ->with('mensaje', 'El PAC se ha actualizado correctamente')
            ->with('icono', 'success');
    }

    // Método para borrar un PAC 
    public function destroy($id) { 
        $pac = Pac::findOrFail($id); 
        $pac->borrado = '1'; // Asegúrate de usar el nombre correcto del campo
        $pac->precio = '0';
        $pac->save();
    
      //  $pac->delete(); 
        return redirect()->route('pacs.index') ->with('mensaje', 'El PAC se ha Anulado correctamente') ->with('icono', 'success'); }

// En tu controlador


}

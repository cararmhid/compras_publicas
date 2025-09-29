<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poa;
use App\Models\Depar;
use App\Models\Direccion;

class PoaController extends Controller
{
    // Método para mostrar la lista de POAs
    public function index()
    {
        $poas = Poa::with(['direccion', 'depar'])->get();

        return view('poa.index', compact('poas'));

        //return view('poas.index', compact('poas, direccions, depars'));
    }

    // Método para mostrar el formulario de creación de un POA
    public function create()
    {

        $direccions = Direccion::all();
        $depars = Depar::all();

        return view('poa.create', compact('direccions', 'depars'));
    }

    // Método para almacenar un nuevo POA
    public function store(Request $request)
    {
        $request->validate([
            'meta' => 'required',
            'id_direcc' => 'required',
            'id_dpto' => 'required',
            'fecha_ini' => 'required',
            'fecha_fin' => 'required',
            'valor' => 'required',
        ]);
        
        $poas = new poa();

        $poas->meta = $request->meta;
        $poas->id_direcc = $request->id_direcc;
        $poas->id_dpto = $request->id_dpto;
        $poas->fecha_ini = $request->fecha_ini;
        $poas->fecha_fin = $request->fecha_fin;
        $poas->valor = $request->valor;

        $poas->save();

        return redirect()->route('poas.index')
            ->with('mensaje', 'El POA se ha creado correctamente')
            ->with('icono', 'success');
    }

    // Método para mostrar el formulario de edición de un POA
    public function edit($id)
    {
        $poa = Poa::findOrFail($id);
        $direccions = Direccion::all();
        $depars = Depar::all();
        return view('poa.edit', compact('poa', 'direccions', 'depars'));
    }

    // Método para actualizar un POA
    public function update(Request $request, $id)
    {
        $request->validate([
            'meta' => 'required',
            'id_direcc' => 'required',
            'id_dpto' => 'required',
            'fecha_ini' => 'required',
            'fecha_fin' => 'required',
            'valor' => 'required',
        ]);

        $poa = Poa::findOrFail($id);
        $poa->update($request->all());

        return redirect()->route('poas.index')
            ->with('mensaje', 'El POA se ha actualizado correctamente')
            ->with('icono', 'success');
    }

    // Método para borrar un POA 
    public function destroy($id) { 
        $poa = Poa::findOrFail($id); 
        $poa->delete(); 
        return redirect()->route('poas.index') ->with('mensaje', 'El POA se ha eliminado correctamente') ->with('icono', 'success'); }

        public function solicitud()
        {
            $poas = Poa::with(['direccion', 'depar'])->get();
    
            return view('poa.solicitud', compact('poas'));
    

}
}
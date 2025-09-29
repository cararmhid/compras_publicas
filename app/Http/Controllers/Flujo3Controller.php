<?php

namespace App\Http\Controllers;

use App\Models\Flujo3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illiminate\Support\Facades\DB;

class Flujo3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flujo3s = flujo3::all();
        return view('flujo3.index', ['flujo3s' => $flujo3s]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('flujo3.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'orden' => 'required',
            'dpto' => 'required',            
            'descripcion' => 'required',
            'id_user' => 'required',
            'tiempo' => 'required',   
            'formulario' => 'required', 

        ]);

        $flujo3s = new Flujo3();

        $flujo3s->orden = $request->orden;
        $flujo3s->dpto = $request->dpto;
        $flujo3s->descripcion = $request->input('descripcion');
        $flujo3s->id_user = $request->id_user;
        $flujo3s->tiempo = $request->tiempo;
        $flujo3s->formulario = $request->formulario;
       

        $flujo3s->save();

        //return redirect()->route('flujo3s.index')->with('mensaje','Se registro el archivo de la manera correcta');
        return redirect()->route('flujo3s.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $flujo3s = flujo3::findorFail($id);

        //return response()->json($formato);
        return view ('flujo3.show',['flujo3s'=>$flujo3s]);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $flujo3s = flujo3::findorFail($id);
        //return response()->json($formato);
        return view('flujo3.edit',['flujo3s'=>$flujo3s]);
        
    }
    public function update(Request $request, $id){


        echo "----------------------------------------------------------------------------------hola";
        $request->validate([
            'orden' => 'required',
            'dpto' => 'required',            
            'descripcion' => 'required',
            'id_user' => 'required',
            'tiempo' => 'required',   
            'formulario' => 'required',
            
        ]);

        $flujo3s = flujo3::find($id);

        $flujo3s->orden = $request->orden;
        $flujo3s->dpto = $request->dpto;
        $flujo3s->descripcion = $request->descripcion;
        $flujo3s->id_user = $request->id_user;
        $flujo3s->tiempo = $request->tiempo;
        $flujo3s->formulario = $request->formulario;

              $flujo3s->save();
              
              return redirect()->route('flujo3s.index')->with('mensaje','Se registro el archivo de la manera correcta');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flujo3s = flujo3::findOrFail($id);
        //Storage::delete('public/'.$formato->url);
        $flujo3s::destroy($id);
        return redirect()->route('flujo3s.index')->with('mensaje','Se elimino al miembro de la manera correcta');
    }
}

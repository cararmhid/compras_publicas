<?php

namespace App\Http\Controllers;

use App\Models\Flujo4;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illiminate\Support\Facades\DB;

class Flujo4Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flujo4s = flujo4::all();
        return view('flujo4.index', ['flujo4s' => $flujo4s]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('flujo4.create');
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

        $flujo4s = new flujo4();

        $flujo4s->orden = $request->orden;
        $flujo4s->dpto = $request->dpto;
        $flujo4s->descripcion = $request->descripcion;
        $flujo4s->id_user = $request->id_user;
        $flujo4s->tiempo = $request->tiempo;
        $flujo4s->formulario = $request->formulario;
       

        $flujo4s->save();

        //return redirect()->route('flujo4s.index')->with('mensaje','Se registro el archivo de la manera correcta');
        return redirect()->route('flujo4s.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $flujo4s = flujo4::findorFail($id);

        //return response()->json($formato);
        return view ('flujo4.show',['flujo4s'=>$flujo4s]);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $flujo4s = flujo4::findorFail($id);
        //return response()->json($formato);
        return view('flujo4.edit',['flujo4s'=>$flujo4s]);
        
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

        $flujo4s = flujo4::find($id);

        $flujo4s->orden = $request->orden;
        $flujo4s->dpto = $request->dpto;
        $flujo4s->descripcion = $request->input('descripcion');
        $flujo4s->id_user = $request->id_user;
        $flujo4s->tiempo = $request->tiempo;
        $flujo4s->formulario = $request->formulario;

              $flujo4s->save();
              
              return redirect()->route('flujo4s.index')->with('mensaje','Se registro el archivo de la manera correcta');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flujo4s = flujo4::findOrFail($id);
        //Storage::delete('public/'.$formato->url);
        $flujo4s::destroy($id);
        return redirect()->route('flujo4s.index')->with('mensaje','Se elimino al miembro de la manera correcta');
    }
}

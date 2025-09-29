<?php

namespace App\Http\Controllers;

use App\Models\Flujo2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illiminate\Support\Facades\DB;

class Flujo2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flujo2s = flujo2::all();
        return view('flujo2.index', ['flujo2s' => $flujo2s]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('flujo2.create');
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

        $flujo2s = new flujo2();

        $flujo2s->orden = $request->orden;
        $flujo2s->dpto = $request->dpto;
        $flujo2s->descripcion = $request->descripcion;
        $flujo2s->id_user = $request->id_user;
        $flujo2s->tiempo = $request->tiempo;
        $flujo2s->formulario = $request->formulario;
       

        $flujo2s->save();

        //return redirect()->route('flujo2s.index')->with('mensaje','Se registro el archivo de la manera correcta');
        return redirect()->route('flujo2s.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $flujo2s = flujo2::findorFail($id);

        //return response()->json($formato);
        return view ('flujo2.show',['flujo2s'=>$flujo2s]);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $flujo2s = flujo2::findorFail($id);
        //return response()->json($formato);
        return view('flujo2.edit',['flujo2s'=>$flujo2s]);
        
    }
    public function update(Request $request, $id){
        
        $request->validate([
            'orden' => 'required',
            'dpto' => 'required',            
            'descripcion' => 'required',
           // 'descripcion' => 'required|string|max:1000',
            'id_user' => 'required',
            'tiempo' => 'required',   
            'formulario' => 'required',
            
        ]);

        $flujo2s = flujo2::find($id);

        $flujo2s->orden = $request->orden;
        $flujo2s->dpto = $request->dpto;
        //$flujo2s->descripcion = $request->descripcion;
        $flujo2s->descripcion = $request->input('descripcion');
        $flujo2s->id_user = $request->id_user;
        $flujo2s->tiempo = $request->tiempo;
        $flujo2s->formulario = $request->formulario;

              $flujo2s->save();
              
              return redirect()->route('flujo2s.index')->with('mensaje','Se registro el archivo de la manera correcta');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flujo2s = flujo2::findOrFail($id);
        //Storage::delete('public/'.$formato->url);
        $flujo2s::destroy($id);
        return redirect()->route('flujo2s.index')->with('mensaje','Se elimino al miembro de la manera correcta');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Flujo1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illiminate\Support\Facades\DB;

class Flujo1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flujo1s = flujo1::all();
        return view('flujo1.index', ['flujo1s' => $flujo1s]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('flujo1.create');
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

        $flujo1s = new flujo1();

        $flujo1s->orden = $request->orden;
        $flujo1s->dpto = $request->dpto;
        $flujo1s->descripcion = $request->descripcion;
        $flujo1s->id_user = $request->id_user;
        $flujo1s->tiempo = $request->tiempo;
        $flujo1s->formulario = $request->formulario;
       

        $flujo1s->save();

        //return redirect()->route('flujo1s.index')->with('mensaje','Se registro el archivo de la manera correcta');
        return redirect()->route('flujo1s.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $flujo1s = flujo1::findorFail($id);

        //return response()->json($formato);
        return view ('flujo1.show',['flujo1s'=>$flujo1s]);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $flujo1s = flujo1::findorFail($id);
        //return response()->json($formato);
        return view('flujo1.edit',['flujo1s'=>$flujo1s]);
       
    }
    public function update(Request $request, $id){


        $request->validate([
            'orden' => 'required',
            'dpto' => 'required',            
            'descripcion' => 'required',
            'id_user' => 'required',
            'tiempo' => 'required',   
            'formulario' => 'required',
            
        ]);

        $flujo1s = flujo1::find($id);

        $flujo1s->orden = $request->orden;
        $flujo1s->dpto = $request->dpto;
        $flujo1s->descripcion = $request->input('descripcion');
        $flujo1s->id_user = $request->id_user;
        $flujo1s->tiempo = $request->tiempo;
        $flujo1s->formulario = $request->formulario;

              $flujo1s->save();
              
              return redirect()->route('flujo1s.index')->with('mensaje','Se registro el archivo de la manera correcta');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flujo1s = flujo1::findOrFail($id);
        //Storage::delete('public/'.$formato->url);
        $flujo1s::destroy($id);
        return redirect()->route('flujo1s.index')->with('mensaje','Se elimino al miembro de la manera correcta');
    }
}

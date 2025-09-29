<?php

namespace App\Http\Controllers;

use App\Models\flujo5;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illiminate\Support\Facades\DB;

class flujo5Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flujo5s = flujo5::all();
        return view('flujo5.index', ['flujo5s' => $flujo5s]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('flujo5.create');
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

        $flujo5s = new flujo5();

        $flujo5s->orden = $request->orden;
        $flujo5s->dpto = $request->dpto;
        $flujo5s->descripcion = $request->descripcion;
        $flujo5s->id_user = $request->id_user;
        $flujo5s->tiempo = $request->tiempo;
        $flujo5s->formulario = $request->formulario;
       

        $flujo5s->save();

        //return redirect()->route('flujo5s.index')->with('mensaje','Se registro el archivo de la manera correcta');
        return redirect()->route('flujo5s.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $flujo5s = flujo5::findorFail($id);

        //return response()->json($formato);
        return view ('flujo5.show',['flujo5s'=>$flujo5s]);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $flujo5s = flujo5::findorFail($id);
        //return response()->json($formato);
        return view('flujo5.edit',['flujo5s'=>$flujo5s]);
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

        $flujo5s = flujo5::find($id);

        $flujo5s->orden = $request->orden;
        $flujo5s->dpto = $request->dpto;
        $flujo5s->descripcion = $request->input('descripcion');
        $flujo5s->id_user = $request->id_user;
        $flujo5s->tiempo = $request->tiempo;
        $flujo5s->formulario = $request->formulario;

              $flujo5s->save();
              
              return redirect()->route('flujo5s.index')->with('mensaje','Se registro el archivo de la manera correcta');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flujo5s = flujo5::findOrFail($id);
        //Storage::delete('public/'.$formato->url);
        $flujo5s::destroy($id);
        return redirect()->route('flujo5s.index')->with('mensaje','Se elimino al miembro de la manera correcta');
    }
}

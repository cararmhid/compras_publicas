<?php

namespace App\Http\Controllers;

use App\Models\direccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illiminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class direccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $direccions = direccion::all();
        return view('direccion.index', ['direccions' => $direccions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('direccion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nro_sec' => 'required',
            'direcc' => 'required',
            'iniciales' => 'required',
            'responsable' => 'required',
            'id_user' => 'required',
            'cargo' => 'required',
          ]);

        $direccions = new direccion();

        $direccions->nro_sec = $request->nro_sec;
        $direccions->direcc = $request->direcc;
        $direccions->iniciales = $request->iniciales;
        $direccions->responsable = $request->responsable;
        $direccions->id_user = $request->id_user;
        $direccions->cargo = $request->cargo;
 

        $direccions->save();

        return redirect()->route('direcciones.index')->with('mensaje','Se elimino al miembro de la manera correcta');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $direccions = direccion::findorFail($id);

        //return response()->json($formato);
        return view ('direccion.show',['direccions'=>$direccions]);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $direccions = direccion::findorFail($id);
        //return response()->json($formato);
        return view('direccion.edit',['direccions'=>$direccions]);
        
    }
    public function update(Request $request, $id){


        $request->validate([
            'nro_sec' => 'required',
            'direcc' => 'required',
            'iniciales' => 'required',
            'responsable' => 'required',
            'id_user' => 'required',
            'cargo' => 'required',
            
        ]);

        $direccions = direccion::find($id);

 
        $direccions->nro_sec = $request->nro_sec;
        $direccions->direcc = $request->direcc;
        $direccions->iniciales = $request->iniciales;
        $direccions->responsable = $request->responsable;
        $direccions->id_user = $request->id_user;
        $direccions->cargo = $request->cargo;   

              $direccions->save();
              
              return redirect()->route('direcciones.index')->with('mensaje','Se registro el archivo de la manera correcta');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse

    {
        Direccion::find($id)->delete();

        return Redirect::route('direcciones.index')
            ->with('success', 'Direccion deleted successfully');
    }

}

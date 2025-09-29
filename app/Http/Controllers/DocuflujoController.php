<?php

namespace App\Http\Controllers;

use App\Models\docuflujo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illiminate\Support\Facades\DB;

class DocuflujoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docuflujos = docuflujo::all();
        return view('docuflujo.index', ['docuflujos' => $docuflujos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('docuflujo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required',
            'flujo' => 'required',
          ]);

        $docuflujos = new docuflujo();

        $docuflujos->documento = $request->documento;
        $docuflujos->flujo = $request->flujo;
 
        $docuflujos->save();

        //return redirect()->route('docuflujos.index')->with('mensaje','Se registro el archivo de la manera correcta');
        return redirect()->route('docuflujos.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $docuflujos = docuflujo::findorFail($id);

        //return response()->json($formato);
        return view ('docuflujo.show',['docuflujos'=>$docuflujos]);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $docuflujos = docuflujo::findorFail($id);
        //return response()->json($formato);
        return view('docuflujo.edit',['docuflujos'=>$docuflujos]);
        
    }
    public function update(Request $request, $id){


        $request->validate([
            'documento' => 'required',
            'flujo' => 'required',
             
        ]);

        $docuflujos = docuflujo::find($id);

 
        $docuflujos->documento = $request->input('documento');
        $docuflujos->flujo = $request->flujo;
  

              $docuflujos->save();
              
              return redirect()->route('docuflujos.index')->with('mensaje','Se registro el archivo de la manera correcta');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $docuflujos = docuflujo::findOrFail($id);
        //Storage::delete('public/'.$formato->url);
        $docuflujos::destroy($id);
        return redirect()->route('docuflujos.index')->with('mensaje','Se elimino al miembro de la manera correcta');
    }
}

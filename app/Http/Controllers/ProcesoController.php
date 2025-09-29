<?php
namespace App\Http\Controllers;

use App\Models\proceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illiminate\Support\Facades\DB;

class procesoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $procesos = proceso::all();
  
        return view('proceso.index', ['procesos' => $procesos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proceso.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'proceso' => 'required',
            'regimen' => 'required',
     
          ]);

        $procesos = new proceso();

        $procesos->proceso = $request->proceso;
        $procesos->regimen = $request->regimen;
  
 
        $procesos->save();

       return redirect()->route('procesos.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $procesos = proceso::findorFail($id);

        //return response()->json($formato);
        return view ('proceso.show',['procesos'=>$procesos]);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $procesos = proceso::findorFail($id);

        return view('proceso.edit',['procesos'=>$procesos]);
        
    }
    public function update(Request $request, $id){

        $request->validate([
            'proceso' => 'required',
            'regimen' => 'required',
  
             
        ]);

        $procesos = proceso::find($id);

        $procesos->proceso = $request->proceso;
        $procesos->regimen = $request->regimen;
  

              $procesos->save();
              
              return redirect()->route('procesos.index')->with('mensaje','Se registro el archivo de la manera correcta');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $procesos = proceso::findOrFail($id);
        //Storage::delete('public/'.$formato->url);
        $procesos::destroy($id);
        return redirect()->route('procesos.index')->with('mensaje','Se elimino al miembro de la manera correcta');
    }
}



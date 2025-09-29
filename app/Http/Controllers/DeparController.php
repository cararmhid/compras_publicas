<?php
namespace App\Http\Controllers;

use App\Models\depar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illiminate\Support\Facades\DB;

class DeparController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depars = depar::all();
        return view('depar.index', ['depars' => $depars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('depar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dpto' => 'required',
     
          ]);

        $depars = new depar();

        $depars->dpto = $request->dpto;
  
 
        $depars->save();

        //return redirect()->route('depars.index')->with('mensaje','Se registro el archivo de la manera correcta');
        return redirect()->route('depars.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $depars = depar::findorFail($id);

        //return response()->json($formato);
        return view ('depar.show',['depars'=>$depars]);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $depars = depar::findorFail($id);
        //return response()->json($formato);
        return view('depar.edit',['depars'=>$depars]);
        
    }
    public function update(Request $request, $id){

        $request->validate([
            'dpto' => 'required',
  
             
        ]);

        $depars = depar::find($id);

        $depars->dpto = $request->dpto;
  

              $depars->save();
              
              return redirect()->route('depars.index')->with('mensaje','Se registro el archivo de la manera correcta');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $depars = depar::findOrFail($id);
        //Storage::delete('public/'.$formato->url);
        $depars::destroy($id);
        return redirect()->route('depars.index')->with('mensaje','Se elimino al miembro de la manera correcta');
    }
}



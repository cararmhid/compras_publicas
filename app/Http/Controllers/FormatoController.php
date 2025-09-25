<?php

namespace App\Http\Controllers;

use App\Models\Formato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illiminate\Support\Facades\DB;

class FormatoController extends Controller
{
    public function index() {
        $formatos = Formato::all();
        return view('formatos.index', ['formatos' => $formatos]);
    }

    public function create()
    {
        return view('formatos.create');
    }

    public function store(Request $request){
        //$formato = request()->all();
        //return response()->json($formato);

        $request->validate([
            'descripcion' => 'required',
            'url' => 'required',
        ]);

        $formato = new Formato();

        $formato->descripcion = $request->descripcion;
        $formato->url = $request->file('url')->store('public/formatos') ?? $request->url;

        $formato->save();

        return redirect()->route('formatos.index')->with('mensaje','Se registro el archivo de la manera correcta'); 

    }
}

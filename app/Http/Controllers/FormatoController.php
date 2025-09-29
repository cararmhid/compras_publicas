<?php

namespace App\Http\Controllers;

use App\Models\Formato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illiminate\Support\Facades\DB;

class FormatoController extends Controller
{
 /*   function __construct()
    {
        $this->middleware('permission:ver-formato|crear-formato|editar-formato|borrar-formato')->only('index');
        $this->middleware('permission:crear-formato',['only'=>['create','store']]);
        $this->middleware('permission:editar-formato',['only'=>['edit','update']]);
        $this->middleware('permission:borrar-formato',['only'=>['destroy']]);
    }*/

    public function index() {
        $formatos = Formato::all();
        return view('formatos.index', compact('formatos'));

      //  $formatos = Formato::orderBy('id')->get(['descripcion', 'url']);
      //  return view('formatos.index', compact('formatos'));
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

        if ($request->hasFile('url')) {
            $filename = $request->file('url')->getClientOriginalName();
            $path = $request->file('url')->storeAs('public/formatos', $filename);
            $formato->url = $path ?? $request->url;
        }

        $formato->save();

        return redirect()->route('formatos.index')->with('mensaje','Se registro el archivo de la manera correcta')->with('icono','success');
    }

    public function show($id){
        $formato = Formato::findorFail($id);

        //return response()->json($formato);
        return view ('formatos.show',['formato'=>$formato]);
    }


    public function edit(Formato $formato){
        //$formato = Formato::findorFail($id);
        //return response()->json($formato);
        return view ('formatos.edit', compact('formato'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'descripcion' => 'required',
            //'url' => 'required',
        ]);

        $formato = Formato::find($id);

        $formato->descripcion = $request->descripcion;

        if ($request->hasFile('url')) {
            $filename = $request->file('url')->getClientOriginalName();
            $path = $request->file('url')->storeAs('public/formatos', $filename);
            $formato->url = $path ?? $request->url;
        }

        $formato->save();

        return redirect()->route('formatos.show', $formato->id)
            ->with('mensaje','Se actualizó el archivo de la manera correcta')
            ->with('icono','success');
    }

    public function download($id) {
        $formato = Formato::findOrFail($id);
        // Asegúrate de que la URL sea la correcta según cómo almacenas los archivos
        $filePath = str_replace('public/', '', $formato->url);
    
        // Verificar si el archivo existe
        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()->route('formatos.index')->with('error', 'El archivo ' . $formato->url . ' no existe.');
        }
    
        // Obtener la ruta completa del archivo
        $file = Storage::disk('public')->path($filePath);
    
        // Descargar el archivo directamente
        return response()->download($file);
    }

    public function destroy($id){
        $formato = Formato::findOrFail($id);
        //Storage::delete('public/'.$formato->url);
        $formato::destroy($id);
        return redirect()->route('formatos.index')
        ->with('mensaje','Se elimino el archivo de la manera correcta')
        ->with('icono','success');
    }
}

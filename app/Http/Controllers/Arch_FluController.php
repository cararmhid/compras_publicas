<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arch_Flu;
use App\Models\Docuflujo;
use App\Models\Necesidad;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use ZipArchive;
use File;

class Arch_FluController extends Controller
{
   
    public function index() {
       
        $docuflujos = Docuflujo::all();
        $necesidads = Necesidad::all();
        
        $id = (auth()->user()->id);
        $arch_flus = arch_flu::where('nro_nec', session('nro_necn'))
        ->where('nro_nec1', session('nro_nec1'))
        ->where('estado', 0)
        ->orderBy('documento', 'asc')
        ->get();
        
        
        return view('arch_flu.index', compact('arch_flus', 'docuflujos', 'necesidads', 'id'));
    }



    public function create() {
      
        $necesidads = Necesidad::all();
        $tipo_flujo = Necesidad::where('nro_nec', session('nro_necn'))->value('tipo_flujo');
        $docuflujos = Docuflujo::all();
        switch ($tipo_flujo) {
            case 'Infima Cuantía':
                // Código para 'infima cuantia'
                $docuflujos = Docuflujo:: orderby('documento', 'asc')->where ('flujo', 1)->get();
                break;
            case 'Catálogo Electrónico':
                // Código para 'catalogo'
                $docuflujos = Docuflujo:: orderby('documento', 'asc')->where ('flujo', 2)->get();
                break;
            case 'Común':
                // Código para 'comun'
                $docuflujos = Docuflujo:: orderby('documento', 'asc')->where ('flujo', 3)->get();
                break;
            case 'Especial':
                    // Código para 'comun'
                $docuflujos = Docuflujo:: orderby('documento', 'asc')->where ('flujo', 4)->get();
                break;
            case 'VPN':
                    // Código para 'comun'
                $docuflujos = Docuflujo:: orderby('documento', 'asc')->where ('flujo', 5)->get();
                break;
        }
       
        $necesidads = Necesidad::all();
        $arch_flus = Arch_Flu::all();

        $arch_flus = arch_flu::where('nro_nec', session('nro_necn'))
        ->where('nro_nec1', session('nro_nec1'))
        ->where('estado','0')
        ->orderBy('documento', 'asc')
        ->get();

        return view('arch_flu.create', compact('arch_flus', 'docuflujos', 'necesidads'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required',
            'nombre_doc' => 'required|file',
        ]);
    
        $nro_nec = session('nro_necn');
        $nro_nec1 = session('nro_nec1');
        $documento = $request->documento;
    
        // Verificar si el archivo ya existe
        $existingFile = Arch_Flu::where('nro_nec', $nro_nec)
            ->where('nro_nec1', $nro_nec1)
            ->where('documento', $documento)
            ->where('estado', '0')
            ->first();
    
        if ($existingFile) {
            // Redirigir con un mensaje de error si el archivo ya existe
            return redirect()->route('arch_flus.index')->with('mensaje', 'El archivo ANTIGUO todavía existe. Por favor, elimínalo primero.');
        }
    
        $arch_flus = new Arch_Flu();
        $arch_flus->documento = $request->documento;
        $arch_flus->nro_nec = $nro_nec;
        $arch_flus->nro_nec1 = $nro_nec1;
        $arch_flus->estado = '0';
        $arch_flus->id_user = session('user_id');
    
        if ($request->hasFile('nombre_doc')) {
            // Obtener el archivo de la solicitud
            $archivo = $request->file('nombre_doc');
    
            // Definir el nuevo nombre del archivo
            $nuevoNombre = $nro_nec . ' ' . $nro_nec1 . ' ' . $documento . '.' . $archivo->getClientOriginalExtension();
    
            // Mover el archivo a la ubicación deseada con el nuevo nombre
            $path = $archivo->storeAs('public/archivos', $nuevoNombre);
            $arch_flus->nombre_doc = $path;
        }
    
        $arch_flus->save();
    
        return redirect()->route('arch_flus.index')->with('mensaje', 'Se registró el archivo de la manera correcta.');
    }
    

    public function show($id) {
        $arch_flu = Arch_Flu::findOrFail($id);
        return view('arch_flus.show', ['arch_flu' => $arch_flu]);
    }

    public function edit($id) {
        $arch_flu = Arch_Flu::findOrFail($id);
        return view('arch_flus.edit', ['arch_flu' => $arch_flu]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'descripcion' => 'required',
            'archivo' => 'required|file',
            //'archivo' => 'required|file',
        ]);

        $arch_flu = Arch_Flu::findOrFail($id);
        $arch_flu->descripcion = $request->descripcion;

        if ($request->hasFile('archivo')) {
            $filename = time() . '-' . $request->file('archivo')->getClientOriginalName();
            $path = $request->file('archivo')->storeAs('public/arch_flus', $filename);
            $arch_flu->archivo = $path;
        }

        $arch_flu->save();

        return redirect()->route('arch_flus.index')
            ->with('mensaje', 'Se actualizó el archivo de la manera correcta')
            ->with('icono', 'success');
    }

    public function destroy(Request $request,  $id)
    {
        $arch_flu = Arch_Flu::findOrFail($id);
        session(['id_reg'  => $id]);
        $filePath = str_replace('public/', '', $arch_flu->nombre_doc);
    
        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()->route('arch_flus.index')->with('error', 'El archivo ' . $arch_flu->url . ' no existe.');
        }
    
        $file = Storage::disk('public')->path($filePath);
        $timestamp = date('Ymd_His'); // Obtiene la fecha y hora actual en formato YYYYMMDD_HHMMSS
        $destinationPath = storage_path('app/public/papelera/'   . basename($filePath). '_'. $timestamp);
    
        if (!file_exists(dirname($destinationPath))) {
            mkdir(dirname($destinationPath), 0755, true);
        }
    
        copy($file, $destinationPath);

             // Eliminar el archivo del almacenamiento
             Storage::delete($arch_flu->nombre_doc);
         
        $arch_flus = Arch_Flu::findOrFail($id);
        $arch_flus->estado='1';
        $arch_flus->id_user=session('user_id');
        $arch_flus->save();

                
        return redirect()->route('arch_flus.index')->with('mensaje', 'Se eliminó el archivo de la manera correcta');
    }



    public function download($id) {
        $arch_flu = Arch_Flu::findOrFail($id);
        $filePath = str_replace('public/', '', $arch_flu->nombre_doc);

        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()->route('arch_flus.index')->with('error', 'El archivo ' . $arch_flu->url . ' no existe.');
        }

        $file = Storage::disk('public')->path($filePath);
        return response()->download($file);
    }

  

}
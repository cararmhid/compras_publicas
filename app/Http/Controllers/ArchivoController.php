<?php

namespace App\Http\Controllers;

use App\Models\arch_flu;
use Illuminate\Http\Request;
use ZipArchive;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
{
 
    public function descargarTodos1(Request $request)
    {
        $files = Storage::allFiles('public/archivos'); // Cambia 'public/archivos' por el directorio donde están tus archivos
        $zip = new ZipArchive;
        $zipFileName = 'all_files.zip';
    
        // Obtén los valores de las sesiones
        $nro_necn = session('nro_necn');
        $nro_nec1 = session('nro_nec1');
        $condicion = $nro_necn.' '.$nro_nec1;
              if ($zip->open(storage_path($zipFileName), ZipArchive::CREATE) === TRUE) {
                foreach ($files as $file) {
                    $fileName = basename($file);
                    // Verifica si el archivo empieza con los valores de las sesiones
                    if (strpos($fileName, $condicion) === 0) {
                        $zip->addFile(storage_path('app/' . $file), $fileName);
                    }
                }
                $zip->close();
            }
        
        
        return response()->download(storage_path($zipFileName))->deleteFileAfterSend(true);
    }

    public function descargarTodos(Request $request)
    {
        $files = Storage::allFiles('public/archivos'); // Cambia 'public/archivos' por el directorio donde están tus archivos
        $zip = new ZipArchive;
        $zipFileName = 'all_files.zip';
    
        // Obtén los valores de las sesiones
        $nro_necn = session('nro_necn');
        $nro_nec1 = session('nro_nec1');
        $condicion = $nro_necn . ' ' . $nro_nec1;
    
        if ($zip->open(storage_path($zipFileName), ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file) {
                $fileName = basename($file);
                // Verifica si el archivo empieza con los valores de las sesiones
                if (strpos($fileName, $condicion) === 0) {
                    // Convierte el nombre del archivo a mayúsculas y reemplaza espacios por guiones bajos
                    $newFileName = strtoupper(str_replace(' ', '_', $fileName));
                    $zip->addFile(storage_path('app/' . $file), $newFileName);
                }
            }
            $zip->close();
        }
    
        return response()->download(storage_path($zipFileName))->deleteFileAfterSend(true);
    }
}   
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\DB;



class EnviarWhatsappController extends Controller

{


 public function EnviarWhatsapp(Request $request)
{
    $resultados = DB::table('flujos')
        ->join('users', 'users.id', '=', 'flujos.id_user')
        ->select('users.celular', 'users.name', 'flujos.nro_nec', 'flujos.id_user', 'flujos.estado', 'flujos.status')
        ->where('flujos.estado', 2)
        ->whereNull('flujos.status')
        ->whereNotNull('users.celular')
        ->get();

    foreach ($resultados as $registro) {
        $numero = escapeshellarg($registro->celular);
        $nombre = escapeshellarg($registro->name);
        $nronec = escapeshellarg($registro->nro_nec);

        $comando = "C:\\wamp64\\www\\crud-laravel\\venv\\Scripts\\python.exe C:\\wamp64\\www\\crud-laravel\\scripts\\enviar_whatsapp.py {$numero} {$nombre} {$nronec}";
        exec($comando, $output, $status);

        if ($status !== 0) {
            \Log::error("Fallo al enviar a {$registro->celular}: " . implode("\n", $output));
        } else {
            \Log::info("Mensaje enviado a {$registro->celular}");
            DB::table('flujos')
                ->where('id_user', $registro->id_user)
                ->update(['status' => 'enviado']);
        }

        sleep(2); // Esperar entre envíos
    }

    return response()->json(['mensaje' => 'Mensajes enviados con éxito']);
}


}

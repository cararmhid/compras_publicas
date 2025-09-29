<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormularioController extends Controller
{
    public function index()
    {
        return view('formulario');
    }

    public function store(Request $request)
    {
        // Validar y procesar los datos del formulario
        $request->validate([
            'campo1' => 'required',
            'campo2' => 'required',
        ]);

        // Guardar los datos o realizar alguna acción
        // ...

        return redirect('/formulario')->with('success', 'Formulario enviado correctamente');
    }
}
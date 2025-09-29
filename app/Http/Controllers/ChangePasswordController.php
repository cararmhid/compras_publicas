<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['message' => 'Por favor, inicia sesión para cambiar tu contraseña.']);
        }

        return view('auth.change-password');

    }
    public function updatePassword(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['message' => 'Por favor, inicia sesión para cambiar tu contraseña.']);
        }

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        // Actualizar la contraseña del usuario
        Auth::user()->update(['password' => Hash::make($request->new_password)]);

        // Invalidar y regenerar la sesión para asegurar el logout correcto 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        
        // Guardar el mensaje en la sesión y redirigir a la vista intermedia 
        session()->flash('status', '¡Contraseña actualizada con éxito! Por favor, inicia sesión con tu nueva contraseña.'); 
        return view('force-logout'); 
    }
}


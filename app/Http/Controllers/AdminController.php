<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller

{
    public function index(){
        $usuarios = User::all();
      
            // Guardar el ID del usuario en la sesión
            session(['user_id' => auth()->user()->id]);
            session(['direcc_id' => auth()->user()->id_direcc]);
            session(['nombre' => auth()->user()->name]);
            session(['id_dpto' => auth()->user()->id_dpto]);
            session(['cargo' => auth()->user()->cargo]);
            session(['menu1' => auth()->user()->menu1]);
            session(['menu2' => auth()->user()->menu2]);
            session(['menu3' => auth()->user()->menu3]);
            session(['menu4' => auth()->user()->menu4]);
            session(['menu5' => auth()->user()->menu5]);
            session(['menu6' => auth()->user()->menu6]);
            session(['menu7' => auth()->user()->menu7]);
            session(['menu8' => auth()->user()->menu8]);
            session(['menu9' => auth()->user()->menu9]);
            session(['menu10' => auth()->user()->menu10]);
            session(['menu11' => auth()->user()->menu11]);
            session(['menu12' => auth()->user()->menu12]);
            session(['menu13' => auth()->user()->menu13]);
   
            return view('admin.index',['usuarios'=>$usuarios]);
    }
}

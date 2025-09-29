<?php

namespace App\Http\Controllers;

use App\Models\Depar;
use App\Models\Direccion;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{

    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $usuarios = $query->paginate(100);

        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $direccions = Direccion::orderBy('direcc')->get();
        $depars = Depar::orderBy('dpto')->get();
        return view('admin.usuarios.create',['direccions'=>$direccions,'depars'=>$depars]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'id_direcc' => 'required',
            'id_dpto' => 'required',
          
            
        ]);
    
        // Crear un nuevo usuario
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->id_direcc = $request->id_direcc;
        $usuario->id_dpto = $request->id_dpto;
        $usuario->estado = '1';
        
        $usuario->cargo = $request->cargo;
        $usuario->menu1 = $request->menu1;
        $usuario->menu2 = $request->menu2;
        $usuario->menu3 = $request->menu3;
        $usuario->menu4 = $request->menu4;
        $usuario->menu5 = $request->menu5;
        $usuario->menu6 = $request->menu6;
        $usuario->menu7 = $request->menu7;
        $usuario->menu8 = $request->menu8;
        $usuario->menu9 = $request->menu9;
        $usuario->menu10 = $request->menu10;
        $usuario->menu11 = $request->menu11;
        $usuario->menu12 = $request->menu12;
        $usuario->menu13 = $request->menu13;
        

        
        $usuario->save();
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('usuarios.index')
            ->with('mensaje', 'Se registró al usuario de la manera correcta')
            ->with('icono', 'success');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view ('admin.usuarios.show',['usuario'=>$usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      
        $usuario = User::findOrFail($id);
        $direccions = Direccion::orderBy('direcc')->get();
        $depars = Depar::orderBy('dpto')->get();
     
      //  return view ('admin.usuarios.edit',['usuario'=>$usuario] , ['direccions'=>$direccions], ['depars'=>$depars]);
        return view('admin.usuarios.edit', compact('usuario', 'direccions', 'depars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required |email',
          //  'password' => 'required|confirmed',
            'id_direcc' => 'required',
            'id_dpto' => 'required',
         
            
        ]);

        $usuario = User::find($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->id_direcc = $request->id_direcc;
        $usuario->id_dpto = $request->id_dpto;
        $usuario->cargo = $request->cargo;
        $usuario->menu1 = $request->menu1;
        $usuario->menu2 = $request->menu2;
        $usuario->menu3 = $request->menu3;
        $usuario->menu4 = $request->menu4;
        $usuario->menu5 = $request->menu5;
        $usuario->menu6 = $request->menu6;
        $usuario->menu7 = $request->menu7;
        $usuario->menu8 = $request->menu8;
        $usuario->menu9 = $request->menu9;
        $usuario->menu10 = $request->menu10;
        $usuario->menu11 = $request->menu11;
        $usuario->menu12 = $request->menu12;
        $usuario->menu13 = $request->menu13;
        
        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('mensaje','Se actualizó al usuario de la manera correcta')
            ->with('icono','success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('usuarios.index')
            ->with('mensaje','Se eliminó al usuario de la manera correcta')
            ->with('icono','success');
    }
}



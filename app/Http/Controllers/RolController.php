<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

//agregamos las librerias de spatie definidas en Kernel.php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-rol|crear-rol|editar-rol|borrar-rol',['only'=>['index']]);
        $this->middleware('permission:crear-rol',['only'=>['create','store']]);
        $this->middleware('permission:editar-rol',['only'=>['edit','update']]);
        $this->middleware('permission:borrar-rol',['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::paginate(5);
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.crear',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        //$role->syncPermissions($request->input('permission'));
        $role->syncPermissions(array_map('intval',$request->input('permission')));

        return redirect()->route('roles.index')
        ->with('mensaje','Se registro el rol de la manera correcta')
        ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = $user->roles()->with('permissions')->get(); // Obtiene los roles junto con sus permisos

        return view ('admin.roles.show', compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")
        ->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')  
        ->all();
        return view('admin.roles.editar', compact('role', 'permission', 'rolePermissions'));    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        //$role->syncPermissions($request->input('permission'));
        $role->syncPermissions(array_map('intval',$request->input('permission')));

        return redirect()->route('roles.index')
        ->with('mensaje','Se actualizó el rol satisfactoriamente')
        ->with('icono','success');
;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('roles')->where('id',$id)->delete();
        return redirect()->route('roles.index')
        ->with('mensaje','Se elimino el rol de la manera correcta')
        ->with('icono','success');
    }
}

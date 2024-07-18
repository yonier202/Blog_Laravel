<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'unique:roles,name'],
            'permissions' => 'required|array',
        ]);
        $rol = Role::create([
            'name' => $request->name,
        ]);

        $rol->permissions()->attach($request->permissions); //agregar en la tabla intermedia

        session()->flash('swal', [
            'icon' =>'success',
            'title' => 'Éxito',
            'text' => 'Rol creado correctamente.'
        ]);
        return redirect()->route('admin.roles.edit', $rol);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        // $permission = $role->permissions->pluck('id')->toArray(); //obtener array con los id de los permisos

        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // return $request->all();
        $request->validate([
            'name' => ['required', 'unique:roles,name,'. $role->id],
            'permissions' => 'nullable|array'
        ]);

        $role->update($request->all());

        $role->permissions()->sync($request->permissions); //agregar en la tabla intermedia

        session()->flash('swal', [
            'icon' =>'success',
            'title' => 'Éxito',
            'text' => 'Rol actualizado correctamente.'
        ]);
        return redirect()->route('admin.roles.edit', $role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        session()->flash('swal', [
            'icon' =>'success',
            'title' => 'Éxito',
            'text' => 'Rol eliminado correctamente.'
        ]);

        return redirect()->route('admin.roles.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = $permissions= Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','unique:permissions,name'], //validatcion
        ]);

        $permission = Permission::create($request->all());  //guardar en la bd

        session()->flash('swal', [
           'icon' =>'success',
           'title' => 'Éxito',
            'text' => 'Permiso creado correctamente.'
        ]);

        return redirect()->route('admin.permissions.edit', $permission);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => ['required','unique:permissions,name,'. $permission->id], //validatcion
        ]);

        $permission->update($request->all());  //actualizar en la bd

        session()->flash('swal', [
           'icon' =>'success',
           'title' => 'Éxito',
            'text' => 'Permiso actualizado correctamente.'
        ]);

        return redirect()->route('admin.permissions.edit', $permission);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        session()->flash('swal', [
           'icon' =>'success',
           'title' => 'Éxito',
            'text' => 'Permiso eliminado correctamente.'
        ]);

        return redirect()->route('admin.permissions.index');
    }
}

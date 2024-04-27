<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Inertia\Inertia;

class RoleController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $roles = Role::orderBy('id','ASC')->get();
        return Inertia::render('Settings/Roles/Index',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $permissions = Permission::get();

        return Inertia::render('Settings/Roles/Create', ['permissions'=>$permissions]);
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

        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));

        return Redirect::route('roles.index')
            ->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {

        $role = $role;
        $rolePermissions = $role->permissions;

        return Inertia::render('Settings/Roles/Show', ['role'=>$role, 'rolePermissions'=>$rolePermissions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {


        $role = $role;
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::get();

        return Inertia::render('Settings/Roles/Edit', ['role'=>$role, 'permissions'=>$permissions, 'rolePermissions'=>$rolePermissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Role $role, Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role->update($request->only('name'));

        $role->syncPermissions($request->get('permission'));

        return Redirect::route('roles.index')
            ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {


        $role->delete();
        return Redirect::back()
            ->with('success','Role deleted successfully');
    }

}

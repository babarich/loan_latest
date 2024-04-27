<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Inertia\Inertia;
class PermissionController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $permissions = Permission::all();

        return Inertia::render('Settings/Permissions/Index', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('Settings/Permissions/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        Permission::create($request->only('name'));

        return redirect()->route('permissions.index')
            ->withSuccess(__('Permission created successfully.'));
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

        return view('settings.permissions.edit', [
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {

        $request->validate([
            'name' => 'required|unique:permissions,name,'.$permission->id
        ]);

        $permission->update($request->only('name'));

        return redirect()->route('permissions.index')
            ->withSuccess(__('Permission updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {

        $permission->delete();

        return redirect()->route('permissions.index')
            ->withSuccess(__('Permission deleted successfully.'));
    }
}

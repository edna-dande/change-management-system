<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index ()
    {
        $roles = Role::orderBy('id','DESC')->get();
        return view('admin.roles.index', compact('roles'));
    }
    public function showRole()
    {
        $role = Role::orderBy('id','DESC')->get();
        return view('admin.roles.show', compact('role'));
    }
    public function createRole()
    {
        $roles = Role::all();
        return view('admin.roles.create', compact('roles'));
    }

    public function editRole(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function storeRole(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
        ]);

        $role = Role::create($validatedData);

        $role->save();

        return redirect()->route('roles')
            ->with('success', 'Role created successfully!');

    }

    public function updateRole(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update($validatedData);

        return redirect()->route('roles')
            ->with('success', 'Role updated successfully!');
    }

    public function destroyRole(Role $role)
    {
        $role->delete();

        return redirect()->route('roles')
            ->with('success', 'Role deleted successfully!');

    }
}

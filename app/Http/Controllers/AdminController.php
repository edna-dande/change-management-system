<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\System;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard ()
    {
        $users = User::with('roles')->orderBy('id','DESC')->get();
        return view('admin_dashboard', compact('users'));
    }
    public function showUser(User $user)
    {
//        $user = User::all();
        return view('admin.users.show', compact('user'));
    }

    public function createUser()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
//            'password' => 'required|string|min:8',
        ]);

        $user = User::create($validatedData);

        $password = Str::random(8);

        $user->update([ 'password' => \Hash::make($password) ]);

        return redirect()->route('admin.users')
            ->with('success', 'User created successfully!');
    }

    public function updateUser(Request $request, User $user)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->update($validatedData);

        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully!');
    }

    public function destroyUser(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', 'User deleted successfully!');
    }

    public function showSystems()
    {
        $systems = System::orderBy('id','DESC')->get();
        return view('admin.systems.index', compact('systems'));
    }

    public function editSystem(System $system)
    {
        return view('admin.systems.edit', compact('system'));
    }

    public function storeSystem(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $system = System::create($validatedData);

        $system->save();

        return redirect()->route('admin.systems')
            ->with('success', 'System created successfully!');
    }

    public function updateSystem(Request $request, System $system)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $system->update($validatedData);

        return redirect()->route('admin.systems')
            ->with('success', 'System updated successfully!');
    }

    public function destroySystem(System $system)
    {
        $system->delete();

        return redirect()->route('admin.systems')
            ->with('success', 'System deleted successfully!');
    }

    public function showRoles()
    {
        $roles = Role::orderBy('id','DESC')->get();
        return view('admin.roles.index', compact('roles'));
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

        return redirect()->route('admin.roles')
            ->with('success', 'Role created successfully!');

    }

    public function updateRole(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $role->update($validatedData);

        return redirect()->route('admin.roles')
            ->with('success', 'Role updated successfully!');
    }

    public function destroyRole(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.roles')
            ->with('success', 'Role deleted successfully!');

    }
}

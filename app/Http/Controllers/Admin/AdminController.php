<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard ()
    {
        $users = User::with('roles')->orderBy('id','DESC')->get();
        return view('admin_dashboard', compact('users'));
    }
    public function showUser(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function createUser()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function editUser(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user','roles'));
    }

    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
//            'password' => 'required|string|min:8',
        ]);

        $user = User::create($validatedData);

        RoleUser::create(['role_id'=>$request->role_id,'user_id'=>$user->id]);

        $password = Str::random(8);

        $user->update([ 'password' => \Hash::make($password) ]);

        return redirect()->route('admin.users',['id'=>$user->id])
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
}
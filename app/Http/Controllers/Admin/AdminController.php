<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewUserLoginCredentialsMail;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        $user = $user->load('roles');
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
            'role_ids' => 'required|array',

        ]);

//        dd($validatedData);

        $user = User::create($validatedData);

//        RoleUser::create(['user_id'=>$user->id]);
        $user->roles()->attach($validatedData['role_ids']);

        $password = Str::random(8);

        $user->update([ 'password' => \Hash::make($password) ]);

        Mail::to($user->email)->send(new NewUserLoginCredentialsMail($user->email, $password));

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

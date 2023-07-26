<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard ()
    {
//        $users = User::orderBy('id','DESC')->get();
        return view('admin_dashboard');
    }
}

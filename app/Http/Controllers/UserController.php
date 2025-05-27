<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;

class UserController extends Controller
{
    public function view()
    {
        $users = User::with('role')->get();
        return view('user.dashboard', compact('users')); // kirim variabel $users ke view
    }
}

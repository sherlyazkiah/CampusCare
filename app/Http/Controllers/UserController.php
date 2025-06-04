<?php

namespace App\Http\Controllers;

use App\Models\DamageReport;
use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function view()
    {
        $users = User::with('role')->get();
        return view('user.dashboard', compact('users')); // kirim variabel $users ke view
    }

    public function biodata()
    {

        $users = User::with('role')->get();
        return view('user.FillBiodata', compact('users')); // kirim variabel $users ke view
    }

    
}

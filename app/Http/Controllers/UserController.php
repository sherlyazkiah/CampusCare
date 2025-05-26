<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;

class UserController extends Controller
{
    public function index()
    {
        return view('layouts.user');
    }
    // Menampilkan halaman dashboard
    public function dashboard()
    {
        $reports = Report::latest()->take(3)->get(); // mengambil 3 report terbaru
        return view('user.dashboard', compact('reports'));
        // $user = Auth::user(); // ambil user yang login
        // $reports = $user->reports; // ambil semua report dari user tersebut
        return view('user.dashboard'); // buat file view resources/views/user/dashboard.blade.php
    }

    // Logout user
    // public function logout()
    // {
    //     Auth::logout(); // logout dari sistem
    //     return redirect('/login'); // redirect ke halaman login setelah logout
    // }
}

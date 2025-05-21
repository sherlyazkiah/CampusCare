<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function view()
    {
        $users = User::with('role')->get();
        return view('admin.UserData', compact('users')); // kirim variabel $users ke view
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.UserCreate', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
            'role_id' => 'nullable|exists:roles,id'
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);

        return response()->json(['success' => true]);
        //return redirect('/userdata')->with('success', 'User created successfully');
    }
}

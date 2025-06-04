<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
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
            //'role_id' => 'nullable|exists:roles,id'
            'role_id' => 'required|exists:roles,role_id',

        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            //'role_id' => $request->role_i
            'role_id' => $request->role_id,
        ]);

        return response()->json(['success' => true]);
        //return redirect('/userdata')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // Jika kamu punya relasi role
        return view('admin.edit', compact('user', 'roles'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,role_id',

            //'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|min:6', // hanya divalidasi jika diisi
        ]);

        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->role_id = $request->role_id;

        // Jika password diisi, hash dan simpan
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('userdata.index')->with('success', 'User berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('userdata.index')->with('success', 'User berhasil dihapus.');
    }

    public function show($id)
    {
        $user = User::with('biodata', 'role')->findOrFail($id); // Pastikan model User ada

        return view('admin.UserDetail', compact('user'));
    }

    public function password()
    {
        return view('admin.ChangePassword', compact('user'));
    }

    public function update_profile(Request $request){
        $user = Auth::user();

        // Validasi input
        $validatedData = $request->validate([
    'name' => 'required|string|max:255',
    'username' => [
        'required',
        'string',
        'max:255',
        Rule::unique('users')->ignore($user->id),
    ],
    'email' => [
        'required',
        'email',
        'max:255',
        Rule::unique('biodata', 'email')->ignore($user->biodata ? $user->biodata->id : null),
    ],
]);

        // Update data user & biodata
        // Asumsi: biodata adalah relasi one-to-one dengan user
        $user->username = $validatedData['username'];
        $user->save();

        // Update biodata
        // Jika biodata belum ada, buat baru
        if (!$user->biodata) {
            $user->biodata()->create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
            ]);
        } else {
            $user->biodata->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
            ]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function biodata()
    {

        $users = User::with('role')->get();
        return view('admin.FillBiodata', compact('users')); // kirim variabel $users ke view
    }

public function storeBiodata(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('biodata', 'email')->ignore($user->biodata?->id),
            ],
        ]);

        $user->biodata()->updateOrCreate(
            ['id_user' => $user->id],
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role_id' => $user->role_id ?? 1,
                'username' => $user->username,
                
            ]
        );
        return redirect('/admin/dashboard')->with('success', 'Biodata berhasil disimpan.');
        //return redirect()->back()->with('success', 'Biodata berhasil disimpan.');
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required'],
        'new_password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        throw ValidationException::withMessages([
            'current_password' => 'Current password is incorrect.',
        ]);
    }

    $user->update([
        'password' => Hash::make($request->new_password),
    ]);

    return back()->with('success', 'Password updated successfully.');
}




    }


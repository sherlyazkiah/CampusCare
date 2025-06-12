<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Biodata;
use App\Models\DamageReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    
    public function dashboard()
    {
       $reports = DamageReport::with(['user', 'role', 'room', 'floor', 'facility', 'biodata'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        $users = User::with('role')->get();
        $biodata = Biodata::with(['user.role', 'role', 'class'])->get();
        $pendingCount = DamageReport::where('status', 'Pending')->count();
        $inqueueCount = DamageReport::where('status', 'In_queue')->count();
        $inProgressCount = DamageReport::where('status', 'in_progress')->count();
        $doneCount = DamageReport::where('status', 'done')->count();
        $c1_scales = Criteria::with('scales')->find(1)?->scales ?? collect();
        
        return view('admin.dashboard', compact('users', 'biodata', 'pendingCount', 'inqueueCount', 'inProgressCount','doneCount','reports','c1_scales')); // kirim variabel $users ke view
    }
    
    
    
    public function view()
    {

        $users = User::with('role')->get();
        
        $biodata = Biodata::with(['user.role', 'role', 'class'])->get();
        $pendingCount = DamageReport::where('status', 'Pending')->where('user_id', Auth::id())->count();
        return view('admin.UserData', compact('users', 'biodata', 'pendingCount')); // kirim variabel $users ke view
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

    public function update_profile(Request $request)
    {
        $user = Auth::user();

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
                Rule::unique('biodata', 'email')->ignore($user->id, 'id_user'), // berdasarkan id_user
            ],
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update username di tabel users
        $user->update([
            'username' => $validatedData['username'],
        ]);

        // Cek apakah biodata sudah ada
        $biodata = $user->biodata;

        // Jika belum ada, buat baru
        if (!$biodata) {
            $biodata = $user->biodata()->create([
                'id_user' => $user->id, // wajib di-set manual karena primary key
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'username' => $validatedData['username'],
                'photo_path' => null,
            ]);
        } else {
            $biodata->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'username' => $validatedData['username'],
            ]);
        }

        // Jika ada upload foto baru
        if ($request->hasFile('photo_path')) {
            // Hapus file lama jika ada
            if ($biodata->photo_path && file_exists(public_path('photo_profile/' . $biodata->photo_path))) {
                unlink(public_path('photo_profile/' . $biodata->photo_path));
            }

            $file = $request->file('photo_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('photo_profile'), $filename);

            $biodata->update([
                'photo_path' => $filename,
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


<?php

namespace App\Http\Controllers;

use App\Models\DamageReport;
use Illuminate\Http\Request;
use \App\Models\User;
use App\Models\Biodata;
use Illuminate\Support\Facades\Storage;
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

    public function edit()
    {
        $user = Auth::user();
        $biodata = $user->biodata;

        return view('user.Profile', compact('biodata'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $biodata = $user->biodata;

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'confirm-password' => 'nullable|string|min:6',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update biodata fields
        $biodata->title = $validated['title'];
        $biodata->name = $validated['name'];
        $biodata->email = $validated['email'];

        // Update password jika diisi
        if ($request->filled('confirm-password')) {
            $user->password = bcrypt($request->input('confirm-password'));
            $user->save();
        }

        try {
            // Upload foto jika ada
            if ($request->hasFile('photo')) {
                // Hapus foto lama jika ada
                if ($biodata->photo && Storage::disk('public')->exists($biodata->photo)) {
                    Storage::disk('public')->delete($biodata->photo);
                }

                $file = $request->file('photo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('photo', $filename, 'public');

                $biodata->photo = $path;
            }

            // Simpan perubahan biodata
            $biodata->save();

            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating your profile.');
        }
    }
}

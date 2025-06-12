<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\DamageReport;
use Illuminate\Http\Request;
use \App\Models\User;
use App\Models\Biodata;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use \App\Models\classRoom;

class UserController extends Controller
{
    public function view()
    {
        $users = User::with('role')->get();
        $reports = DamageReport::with(['user', 'facility', 'room', 'floor'])->where('user_id', Auth::id())->latest()->limit(5)->get();;
        $pendingCount = DamageReport::where('status', 'Pending')->where('user_id', Auth::id())->count();
        $processCount = DamageReport::where('status', 'in_progress')->where('user_id', Auth::id())->count();
        $doneCount = DamageReport::where('status', 'done')->where('user_id', Auth::id())->count();
        $c1_scales = Criteria::with('scales')->find(1)?->scales ?? collect();
        //return view('user.dashboard', compact('users')); // kirim variabel $users ke view
        return view('user.dashboard', compact('users', 'reports', 'pendingCount', 'processCount', 'doneCount','c1_scales') );
    }


    public function edit()
    {
        $user = Auth::user();
        $biodata = $user->biodata;
        $classes = classRoom::all();

        return view('user.Profile', compact('biodata', 'classes'));
    }



    public function update(Request $request)
    {
        $user = auth()->user();
        $biodata = $user->biodata;

        $validatedData = $request->validate([
            'identity' => 'required|string|max:255',
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
                Rule::unique('biodata', 'email')->ignore($user->id, 'id_user'),
            ],
            'class_id' => 'nullable|exists:class,class_id',
            'password' => 'nullable|string|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update username dan password
        $user->username = $validatedData['username'];
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->save();

        // Update atau buat biodata
        if (!$biodata) {
            $biodata = $user->biodata()->create([
                'id_user' => $user->id,
                'identity' => $validatedData['identity'],
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'username' => $validatedData['username'],
                'class_id' => $validatedData['class_id'] ?? null,
                'photo_path' => null,
            ]);
        } else {
            $biodata->identity = $validatedData['identity'];
            $biodata->name = $validatedData['name'];
            $biodata->email = $validatedData['email'];
            $biodata->username = $validatedData['username'];
            $biodata->class_id = $validatedData['class_id'] ?? $biodata->class_id;
        }

        // Upload foto ke public/photo_profile
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama
            if ($biodata->photo_path && file_exists(public_path('photo_profile/' . $biodata->photo_path))) {
                unlink(public_path('photo_profile/' . $biodata->photo_path));
            }

            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Pindahkan file ke public/photo_profile
            $file->move(public_path('photo_profile'), $filename);

            $biodata->photo_path = $filename;
        }

        $biodata->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }




    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }




    public function StudentBiodata()
    {

        $users = User::with('role')->get();
        $classrooms = classRoom::all();
        return view('user.StudentFillBiodata', compact('users', 'classrooms')); // kirim variabel $users ke view

    }

    public function StudentStoreBiodata(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'identity' => [
                'required',
                'integer',
                Rule::unique('biodata', 'identity')->ignore($user->biodata?->id),
            ],
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('biodata', 'email')->ignore($user->biodata?->id),
            ],
            'class_id' => 'required|exists:class,class_id',
        ]);

        $user->biodata()->updateOrCreate(
            ['id_user' => $user->id],
            [
                'identity' => $validated['identity'],
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role_id' => $user->role_id ?? 1,
                'username' => $user->username,
                'class_id' => $validated['class_id'],
            ]
        );

        return redirect('/user/dashboard')->with('success', 'Biodata berhasil disimpan.');
    }

    public function LectureBiodata()
    {

        $users = User::with('role')->get();
        return view('user.LectureFillBiodata', compact('users')); // kirim variabel $users ke view

    }
    public function LectureStoreBiodata(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'identity' => [
                'required',
                'integer',
                Rule::unique('biodata', 'identity')->ignore($user->biodata?->id),
            ],
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
                'identity' => $validated['identity'],
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role_id' => $user->role_id ?? 1,
                'username' => $user->username,
            ]
        );
        //dd($request->all());
        return redirect('/user/dashboard')->with('success', 'Biodata berhasil disimpan.');
    }


}

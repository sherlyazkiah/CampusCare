<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TechnicianController extends Controller
{
    public function showTechnicians()
    {
        $technicians = Technician::with('user')->get();
        return view('admin.technician.index', compact('technicians'));
    }

    public function showAddForm()
    {
        return view('admin.technician.create');
    }

    public function addTechnician(Request $request)
    {
        // Validate input
        $this->validateTechnicianData($request);

        // Create user account
        $user = $this->createUserAccount($request);

        // Handle photo upload
        $photoPath = $this->handlePhotoUpload($request);

        // Create technician profile
        $this->createTechnicianProfile($user, $request, $photoPath);

        return redirect()->route('technicians.index')
            ->with('success', 'Technician added successfully');
    }

    public function showEditForm($id)
    {
        $technician = Technician::with('user')->findOrFail($id);
        return view('admin.technician.edit', compact('technician'));
    }

    public function saveTechnician(Request $request, $id)
    {
        $technician = Technician::findOrFail($id);

        // Validate input
        $this->validateTechnicianUpdateData($request, $technician);

        // Handle photo update
        $photoPath = $this->updatePhoto($request, $technician);

        // Update user and technician data
        $this->updateUserData($technician, $request);
        $this->updateTechnicianData($technician, $request, $photoPath);

        return redirect()->route('technicians.index')
            ->with('success', 'Technician information updated');
    }

    public function removeTechnician($id)
    {
        $technician = Technician::findOrFail($id);

        // Remove photo if exists
        if ($technician->photo) {
            Storage::delete('public/' . $technician->photo);
        }

        // Remove user and technician records
        $technician->user->delete();
        $technician->delete();

        return redirect()->route('technicians.index')
            ->with('success', 'Technician removed');
    }

    private function validateTechnicianData(Request $request)
    {
        return $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required',
            'address' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
    }

    private function validateTechnicianUpdateData(Request $request, Technician $technician)
    {
        return $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $technician->user_id,
            'phone' => 'required',
            'address' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
    }

    private function createUserAccount(Request $request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'technician'
        ]);
    }

    private function handlePhotoUpload(Request $request)
    {
        if (!$request->hasFile('photo')) {
            return null;
        }

        $photo = $request->file('photo');
        $filename = time() . '.' . $photo->getClientOriginalExtension();
        $photo->storeAs('public/technician-photos', $filename);
        return 'technician-photos/' . $filename;
    }

    private function createTechnicianProfile(User $user, Request $request, $photoPath)
    {
        return Technician::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $photoPath
        ]);
    }

    private function updatePhoto(Request $request, Technician $technician)
    {
        if (!$request->hasFile('photo')) {
            return $technician->photo;
        }

        if ($technician->photo) {
            Storage::delete('public/' . $technician->photo);
        }

        $photo = $request->file('photo');
        $filename = time() . '.' . $photo->getClientOriginalExtension();
        $photo->storeAs('public/technician-photos', $filename);
        return 'technician-photos/' . $filename;
    }

    private function updateUserData(Technician $technician, Request $request)
    {
        $technician->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $technician->user->update([
                'password' => Hash::make($request->password)
            ]);
        }
    }

    private function updateTechnicianData(Technician $technician, Request $request, $photoPath)
    {
        $technician->update([
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $photoPath
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Floor;
use App\Models\Room;
use App\Models\DamageReport;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $reports = DamageReport::with(['user', 'role', 'room', 'floor'])->get();
        return view('admin.DamageReport', compact('reports'));
    }

    public function userReports()
    {
        $userId = Auth::id(); // Ambil ID user yang sedang login

        $reports = DamageReport::with(['user', 'role', 'room', 'floor'])
            ->where('user_id', $userId)
            ->get();

        return view('user.Report', compact('reports'));
    }

    public function create()
    {
        $facilities = Facility::all();
        $floors = Floor::all();
        $rooms = Room::all();
        $damageLevels = DamageReport::DAMAGE_LEVELS;

        return view('user.CreateReport', compact('facilities', 'floors', 'rooms', 'damageLevels'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'facility' => 'required|string',
            'floor' => 'required|integer',
            'room' => 'required|integer',
            'damage_level' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('damage_photos'), $imageName);
            $imagePath = 'damage_photos/' . $imageName;
        }
    
        $user = Auth::user();
    
        DamageReport::create([
            'report_name' => $request->title,
            'description' => $request->description,
            'damage_level' => $request->damage_level,
            'status' => 'pending',
            'user_id' => $user->id,
            'role_id' => $user->role_id ?? 2,
            'room_id' => $request->room,
            'floor_id' => $request->floor,
            'image_path' => $imagePath,
        ]);
    
        return redirect()->route('user.reports')->with('success', 'Report submitted successfully.');
    }
    

    public function getRoomsByFloor($floor_id)
    {
        $rooms = Room::where('floor_id', $floor_id)->get();
        return response()->json($rooms);
    }
    public function getRooms($floor_id)
    {
        $rooms = Room::where('floor_id', $floor_id)->get();
        return response()->json($rooms);
    }
}

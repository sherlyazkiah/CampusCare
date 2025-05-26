<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Floor;

class RoomController extends Controller
{
    // Menampilkan halaman gabungan floor + room
    public function index()
    {
        $floors = Floor::all();
        $rooms = Room::with('floor')->get();

        return view('admin.FloorData', compact('floors', 'rooms'));
    }

    // Form tambah ruangan
    public function create()
    {
        $floors = Floor::all();
        return view('admin.RoomCreate', compact('floors'));
    }

    // Simpan ruangan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_name' => 'required|string|max:100|unique:rooms,room_name',
            'floor_id' => 'required|exists:floors,floor_id',
        ]);

        Room::create($validated);

        return redirect()->route('floorroomdata.index')->with('success', 'Data ruangan berhasil ditambahkan.');
    }

    // Form edit ruangan
    public function edit(Room $room)
    {
        $floors = Floor::all();
        return view('admin.RoomEdit', compact('room', 'floors'));
    }

    // Update data ruangan
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_name' => 'required|string|max:100|unique:rooms,room_name,' . $room->room_id . ',room_id',
            'floor_id' => 'required|exists:floors,floor_id',
        ]);

        $room->update($validated);

        return redirect()->route('floorroomdata.index')->with('success', 'Data ruangan berhasil diperbarui.');
    }

    // Hapus ruangan
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('floorroomdata.index')->with('success', 'Data ruangan berhasil dihapus.');
    }
}

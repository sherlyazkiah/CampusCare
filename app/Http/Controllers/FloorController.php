<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Room;

class FloorController extends Controller
{
    public function view()
    {
        $floors = Floor::all();
        $rooms = Room::with('floor')->get();
        return view('admin.FloorData', compact('floors', 'rooms'));
    }

    // Tampilkan form tambah data
    public function create()
    {
        return view('admin.FloorCreate');
    }

    // Simpan data baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'floor_number' => 'required|integer',
            'floor_name' => 'required|string|max:100|unique:floors,floor_name',
        ]);

        Floor::create($validated);

        return redirect()->route('floorroomdata.index')->with('success', 'Data lantai berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit(Floor $floor)
    {
        return view('admin.FloorEdit', compact('floor'));
    }

    // Update data
    public function update(Request $request, Floor $floor)
    {
        $validated = $request->validate([
            'floor_number' => 'required|integer',
            'floor_name' => 'required|string|max:100|unique:floors,floor_name,' . $floor->floor_id . ',floor_id',
        ]);

        $floor->update($validated);

        return redirect()->route('floorroomdata.index')->with('success', 'Data lantai berhasil diperbarui.');
    }

    // Hapus data
    public function destroy(Floor $floor)
    {
        $floor->delete();

        return redirect()->route('floorroomdata.index')->with('success', 'Data lantai berhasil dihapus.');
    }
}

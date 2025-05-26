<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Floor;
use App\Models\Room;

class FacilityController extends Controller
{
    public function view()
    {
        $facilities = Facility::with(['floor', 'room'])->get();

        return view('admin.FacilityData', compact('facilities'));
    }
    public function create()
    {
        $floors = Floor::all();
        $rooms = Room::all();
        return view('admin.FacilityCreate', compact('floors', 'rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'facility_name' => 'required|string|max:100|unique:facilities,facility_name',
            'jumlah' => 'required|integer',
            'floor_id' => 'required|exists:floors,floor_id',
            'room_id' => 'required|exists:rooms,room_id',
        ]);

        Facility::create($validated);

        return redirect()->route('facilitydata.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Facility $facility)
    {
        $floors = Floor::all();
        $rooms = Room::all();
        return view('admin.FacilityEdit', compact('facility', 'floors', 'rooms'));
    }

    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'facility_name' => 'required|string|max:100|unique:facilities,facility_name,' . $facility->facility_id . ',facility_id',
            'jumlah' => 'required|integer',
            'floor_id' => 'required|exists:floors,floor_id',
            'room_id' => 'required|exists:rooms,room_id',
        ]);

        $facility->update($validated);

        return redirect()->route('facilitydata.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();
        return redirect()->route('facilitydata.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}

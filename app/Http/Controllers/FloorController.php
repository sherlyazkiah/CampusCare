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
}

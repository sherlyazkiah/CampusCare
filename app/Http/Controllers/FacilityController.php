<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    /**
     * Display a listing of the facilities.
     */

    public function view()
    {
        $facility = Facility::with('role')->get();
        return view('admin.FacilityData', ['facilities' => $facility]);
    }
}

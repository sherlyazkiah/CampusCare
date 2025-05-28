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

    
}

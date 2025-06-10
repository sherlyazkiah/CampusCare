<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Floor;
use App\Models\Room;
use App\Models\DamageReport;
use App\Models\Criteria;
use App\Models\CriterionScale;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        //$reports = DamageReport::with(['user', 'role', 'room', 'floor'])->get();
        //$reports = DamageReport::with(['user', 'role', 'room', 'floor', 'facility'])->get();
        $reports = DamageReport::with(['user', 'role', 'room', 'floor', 'facility', 'biodata'])->get();
        $c1_scales = Criteria::with('scales')->find(1)?->scales ?? collect();
        $c2_scales = Criteria::with('scales')->find(2)?->scales ?? collect();
        $c3_scales = Criteria::with('scales')->find(3)?->scales ?? collect();
        $c4_scales = Criteria::with('scales')->find(4)?->scales ?? collect();
        $c5_scales = Criteria::with('scales')->find(5)?->scales ?? collect();
        $c6_scales = Criteria::with('scales')->find(6)?->scales ?? collect();

        //dd($reports->first());
        return view('admin.DamageReport', compact('reports', 'c1_scales', 'c2_scales', 'c3_scales', 'c4_scales', 'c5_scales', 'c6_scales'));
    }

    public function userReports()
    {
        $userId = Auth::id(); // Ambil ID user yang sedang login

        //$reports = DamageReport::with(['user', 'role', 'room', 'floor'])
        //->where('user_id', $userId)
        //->get();
        $reports = DamageReport::with(['user', 'role', 'room', 'floor', 'facility'])
            ->where('user_id', $userId)
            ->get();

        return view('user.Report', compact('reports'));
    }

    public function create()
    {
        $facilities = Facility::all();
        $floors = Floor::all();
        $rooms = Room::all();
        //$damageLevels = DamageReport::DAMAGE_LEVELS;
        $c1_scales = Criteria::with('scales')->find(1)?->scales ?? collect();
        $c2_scales = CriterionScale::with('scales')->find(2)?->scales ?? collect();
        $c3_scales = CriterionScale::with('scales')->find(3)?->scales ?? collect();
        $c4_scales = CriterionScale::with('scales')->find(4)?->scales ?? collect();
        $c5_scales = CriterionScale::with('scales')->find(5)?->scales ?? collect();

        return view('user.CreateReport', compact(
            'facilities',
            'floors',
            'rooms',
            'c1_scales',
            'c2_scales',
            'c3_scales',
            'c4_scales',
            'c5_scales'
        ));
    }
    public function store(Request $request)
    {

        //dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'c1' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'facility' => 'required|integer',
            'floor' => 'required|integer',
            'room' => 'required|integer',
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
        // dd($request->all());
        $user = Auth::user();

        DamageReport::create([
            'c1' => $request->c1, // Simpan nilai Damage Severity
            'description' => $request->description,
            'status' => 'pending',
            'user_id' => $user->id,
            'role_id' => $user->role_id ?? 2,
            'facility_id' => $request->facility,
            'room_id' => $request->room,
            'floor_id' => $request->floor,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('user.reports')->with('success', 'Report submitted successfully.');
    }

    public function updateCriteria(Request $request, $damage_report_id)
    {
        // Validasi data input criteria c1 - c6
        $validated = $request->validate([
            'c1' => 'required|integer',
            'c2' => 'required|integer',
            'c3' => 'required|integer',
            'c4' => 'required|integer',
            'c5' => 'required|integer',
            'c6' => 'required|integer',
        ]);

        // Cari report berdasarkan id
        $report = DamageReport::findOrFail($damage_report_id);

        // Update nilai criteria
        $report->c1 = $validated['c1'];
        $report->c2 = $validated['c2'];
        $report->c3 = $validated['c3'];
        $report->c4 = $validated['c4'];
        $report->c5 = $validated['c5'];
        $report->c6 = $validated['c6'];

        $report->save();

        // Redirect atau response sesuai kebutuhan
        return redirect()->back()->with('success', 'Damage criteria updated successfully!');
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

    public function showRecommendations()
    {
        // Ambil semua laporan yang memiliki nilai c1-c6 (tidak null)
        $reports = DamageReport::whereNotNull('c1')
            ->whereNotNull('c2')
            ->whereNotNull('c3')
            ->whereNotNull('c4')
            ->whereNotNull('c5')
            ->whereNotNull('c6')
            ->get();

        return view('admin.RepairRecommendation', compact('reports'));
    }

    public function storeAndCalculateVikor(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'c1' => 'required|numeric',
            'c2' => 'required|numeric',
            'c3' => 'required|numeric',
            'c4' => 'required|numeric',
            'c5' => 'required|numeric',
            'c6' => 'required|numeric',
        ]);

        // Simpan nilai kriteria ke database
        $report = DamageReport::findOrFail($id);
        $report->update($validated);

        // Ambil semua data laporan dengan kriteria lengkap
        $reports = DamageReport::whereNotNull('c1')
            ->whereNotNull('c2')
            ->whereNotNull('c3')
            ->whereNotNull('c4')
            ->whereNotNull('c5')
            ->whereNotNull('c6')
            ->get();

        // Proses VIKOR
        $vikorResults = $this->calculateVikor($reports);
        $criteriaLabels = [
            'c1' => 'Damage Severity',
            'c2' => 'Usage Importance',
            'c3' => 'Safety Concern',
            'c4' => 'Repair Urgency',
            'c5' => 'Impact on Many People',
            'c6' => 'Time to Repair',
        ];

        // Tampilkan ke view
        return view('admin.RepairRecommendation', [
            'results' => $vikorResults,
            'reports' => $reports,
            'criteriaLabels' => $criteriaLabels
        ]);
    }
    private function calculateVikor($reports)
    {
        $criteria = ['c1', 'c2', 'c3', 'c4', 'c5', 'c6'];
        $weights = [0.2, 0.15, 0.2, 0.2, 0.15, 0.1]; // contoh bobot
        $costCriteria = ['c6']; // hanya c6 adalah cost

        $matrix = $reports->map(function ($report) use ($criteria) {
            return collect($criteria)->mapWithKeys(function ($c) use ($report) {
                return [$c => $report->$c];
            });
        });

        $fPlus = [];
        $fMinus = [];
        foreach ($criteria as $c) {
            $fPlus[$c] = $matrix->max($c);
            $fMinus[$c] = $matrix->min($c);
        }

        $results = [];
        foreach ($reports as $i => $report) {
            $S = 0;
            $R = 0;
            foreach ($criteria as $index => $c) {
                $weight = $weights[$index];
                $fi = $report->$c;

                // Perbedaan cost vs benefit
                $di = in_array($c, $costCriteria)
                    ? ($fi - $fMinus[$c]) / (($fPlus[$c] - $fMinus[$c]) ?: 1) // cost
                    : ($fPlus[$c] - $fi) / (($fPlus[$c] - $fMinus[$c]) ?: 1); // benefit

                $S += $weight * $di;
                $R = max($R, $weight * $di);
            }
            $results[] = [
                'report' => $report,
                'S' => $S,
                'R' => $R,
            ];
        }

        $SValues = collect($results)->pluck('S');
        $RValues = collect($results)->pluck('R');

        $Smin = $SValues->min();
        $Smax = $SValues->max();
        $Rmin = $RValues->min();
        $Rmax = $RValues->max();

        $v = 0.5;
        foreach ($results as &$res) {
            $res['Q'] = $v * (($res['S'] - $Smin) / (($Smax - $Smin) ?: 1)) +
                (1 - $v) * (($res['R'] - $Rmin) / (($Rmax - $Rmin) ?: 1));
        }

        return collect($results)->sortBy('Q')->values();
    }

    public function showRepairRecommendation()
    {
        $reports = DamageReport::whereNotNull('c1')
            ->whereNotNull('c2')
            ->whereNotNull('c3')
            ->whereNotNull('c4')
            ->whereNotNull('c5')
            ->whereNotNull('c6')
            ->get();

        $results = $this->calculateVikor($reports);


        $technicians = User::whereHas('role', function ($query) {
            $query->where('name', 'technician');
        })->get();

        $criteriaLabels = [
            'c1' => 'Damage Severity',
            'c2' => 'Usage Importance',
            'c3' => 'Safety Concern',
            'c4' => 'Repair Urgency',
            'c5' => 'Impact on Many People',
            'c6' => 'Time to Repair',
        ];

        return view('admin.RepairRecommendation', compact('results', 'reports', 'criteriaLabels', 'technicians'));

    }

}

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
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)

    
    {
        

        $query = DamageReport::with(['user.role', 'facility', 'room', 'floor']);
        if ($request->has('status') && $request->status != '') {


        $query->where('status', $request->status);
    }
    
    
        //$reports = DamageReport::with(['user', 'role', 'room', 'floor'])->get();
        //$reports = DamageReport::with(['user', 'role', 'room', 'floor', 'facility'])->get();
        $reports = DamageReport::with(['user', 'role', 'room', 'floor', 'facility', 'biodata'])->get();
        $loggedInUserId = Auth::id();
        $c1_scales = Criteria::with('scales')->find(1)?->scales ?? collect();


        $c1_scales = Criteria::with('scales')->find(1)?->scales ?? collect();
        $c2_scales = Criteria::with('scales')->find(2)?->scales ?? collect();
        $c3_scales = Criteria::with('scales')->find(3)?->scales ?? collect();
        $c4_scales = Criteria::with('scales')->find(4)?->scales ?? collect();
        $c5_scales = Criteria::with('scales')->find(5)?->scales ?? collect();
        $c6_scales = Criteria::with('scales')->find(6)?->scales ?? collect();
        
     //$reports = $query->latest()->get();
        //dd($reports->first());
        $reports = $query->latest()->paginate(10);
        return view('admin.DamageReport', compact('reports', 'c1_scales', 'c2_scales', 'c3_scales', 'c4_scales', 'c5_scales', 'c6_scales'));
    }

    public function userReports()
    {
        $userId = Auth::id(); // Ambil ID user yang sedang login
        $c1_scales = Criteria::with('scales')->find(1)?->scales ?? collect();

        //$reports = DamageReport::with(['user', 'role', 'room', 'floor'])
        //->where('user_id', $userId)
        //->get();
        $reports = DamageReport::with(['user', 'role', 'room', 'floor', 'facility'])
            ->where('user_id', $userId)
            ->get();

        return view('user.Report', compact('reports','c1_scales'));
    }

    public function create()
    {
        $facilities = Facility::all();
        $floors = Floor::all();
        $rooms = Room::all();
        //$damageLevels = DamageReport::DAMAGE_LEVELS;
        $c1_scales = Criteria::with('scales')->find(1)?->scales ?? collect();
        $c2_scales = Criteria::with('scales')->find(2)?->scales ?? collect();
        $c3_scales = Criteria::with('scales')->find(3)?->scales ?? collect();
        $c4_scales = Criteria::with('scales')->find(4)?->scales ?? collect();
        $c5_scales = Criteria::with('scales')->find(5)?->scales ?? collect();

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
    public function getRoomsByFloor($floor_id)
    {
        $rooms = Room::where('floor_id', $floor_id)->get();

        return response()->json($rooms);
    }
    public function store(Request $request)
    {

        //dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'c1' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'facility' => 'required|exists:facilities,facility_id',
            'floor' => 'required|exists:floors,floor_id',
            'room' => 'required|exists:rooms,room_id',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $exists = DamageReport::where('facility_id', $request->facility)
        ->where('floor_id', $request->floor)
        ->where('room_id', $request->room)
        ->whereIn('status', ['pending', 'in_progress', 'In_Queue'])
        ->exists();

        if ($exists) {
        return back()->withInput()->withErrors(['room' => 'This facility, floor, and room combination has already been reported.']);
    }

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

        
        $report->status = 'In_Queue';
        $report->save();
        $reports = DamageReport::whereNotNull('c1')
            ->whereNotNull('c2')
            ->whereNotNull('c3')
            ->whereNotNull('c4')
            ->whereNotNull('c5')
            ->whereNotNull('c6')
            ->get();

        // Proses VIKOR
        $vikorResults = $this->calculateVikor($reports, $fPlus, $fMinus, $normalized);
        $rankedResults = collect($vikorResults)->sortBy('Q')->values();
        $criteriaLabels = [
            'c1' => 'Damage Severity',
            'c2' => 'Usage Importance',
            'c3' => 'Safety Concern',
            'c4' => 'Repair Urgency',
            'c5' => 'Impact on Many People',
            'c6' => 'Time to Repair',
        ];

        // Tampilkan ke view
        $technicians = User::where('role_id', 4)->get();
        return view('admin.RepairRecommendation', [
            'technicians' => $technicians,
            'results' => $vikorResults,
            'rankedResults' => $rankedResults,
            'reports' => $reports,
            'criteriaLabels' => $criteriaLabels,
            'fPlus' => $fPlus,
            'fMinus' => $fMinus,
            'normalized' => $normalized,
        ]);

    }
    private function calculateVikor($reports, &$fPlus, &$fMinus, &$normalized = [])
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
            if (in_array($c, $costCriteria)) {
                $fPlus[$c] = $matrix->min($c); // untuk cost, f+ adalah minimum
                $fMinus[$c] = $matrix->max($c); // untuk cost, f- adalah maksimum
            } else {
                $fPlus[$c] = $matrix->max($c); // untuk benefit, f+ adalah maksimum
                $fMinus[$c] = $matrix->min($c); // untuk benefit, f- adalah minimum
            }
        }

        $results = [];
        $normalized = [];

        foreach ($reports as $i => $report) {
            $S = 0;
            $R = 0;
            $row = ['name' => $report->facility->facility_name];
            $normalizedRow = [];
            
            foreach ($criteria as $index => $c) {
                $weight = $weights[$index];
                $fi = $report->$c;

                $di = ($fPlus[$c] - $fi) / (($fPlus[$c] - $fMinus[$c]) ?: 1);

                $normalizedRow[$c] = $di * $weight;

                $S += $weight * $di;
                $R = max($R, $weight * $di);
            }

            $normalized[] = $normalizedRow;

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
        return $results;
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

        $results = $this->calculateVikor($reports, $fPlus, $fMinus, $normalized);
        $rankedResults = collect($results)->sortBy('Q')->values();


        $technicianIdsWithInProgress = DamageReport::where('status', 'In Progress')
            ->whereNotNull('technician_id')
            ->pluck('technician_id')
            ->unique();

        $allTechnicianIdsWithReports = DamageReport::whereNotNull('technician_id')
            ->pluck('technician_id')
            ->unique();

        // Teknisi yang tidak punya relasi sama sekali
        $neverAssignedTechnicians = User::with('biodata')
            ->where('role_id', 4)
            ->whereNotIn('id', $allTechnicianIdsWithReports);

        // Teknisi yang hanya punya report dengan status BUKAN "In Progress"
        $techniciansWithOnlyNonInProgress = User::with('biodata')
            ->where('role_id', 4)
            ->whereNotIn('id', $technicianIdsWithInProgress)
            ->whereIn('id', function ($query) {
                $query->select('technician_id')
                    ->from('damage_report')
                    ->whereNotNull('technician_id')
                    ->groupBy('technician_id')
                    ->havingRaw("SUM(status = 'In Progress') = 0"); // Tidak ada status In Progress
            });

        // Gabungkan keduanya
        $technicians = $neverAssignedTechnicians
            ->union($techniciansWithOnlyNonInProgress)
            ->get();


        $criteriaLabels = [
            'c1' => 'Damage Severity',
            'c2' => 'Usage Importance',
            'c3' => 'Safety Concern',
            'c4' => 'Repair Urgency',
            'c5' => 'Impact on Many People',
            'c6' => 'Time to Repair',
        ];
        //$technicians = User::with('biodata')->where('role_id', 4)->get();
        //dd($technicians);

        return view('admin.RepairRecommendation', compact('results', 'reports', 'criteriaLabels', 'technicians', 'rankedResults', 'fPlus', 'fMinus', 'normalized'));
    }

    public function assignTechnician(Request $request)
    {
        $request->validate([
            'damage_report_id' => 'required|exists:damage_report,damage_report_id',
            'technician_id' => 'required|exists:users,id',
        ]);

        $technician = User::find($request->technician_id);
        if ($technician->role_id != 4) {
            return back()->withErrors('Selected user is not a technician.');
        }

        $hasActiveTask = DamageReport::where('technician_id', $technician->id)
            ->whereIn('status', ['pending', 'in_progress', 'assigned'])
            ->exists();

        if ($hasActiveTask) {
            return back()->withErrors('Teknisi ini sudah memiliki tugas yang sedang berlangsung.');
        }


        $report = DamageReport::find($request->damage_report_id); // ✅ ini return satu model, bukan collection
        $report->technician_id = $technician->id;
        $report->status = 'In Progress';
        $report->save();


        return redirect()->route('repair-recommendation')->with('success', 'Technician assigned successfully.');
    }

    public function technicianProgress()
    {

        $c1_scales = Criteria::with('scales')->find(1)?->scales ?? collect();
        $reports = DamageReport::with([
            'user',       // reporter
            'role',       // reporter role (e.g. Student/Technician)
            'facility',
            'floor',
            'room'
        ])
            ->whereNotNull('technician_id')
            ->where('status', 'In Progress')
            ->orderBy('damage_report_id', 'asc')
            ->get();
        return view('admin.TechnicianProgress', compact('reports', 'c1_scales'));
    }

    public function exportPDF()
    {
        $reports = DamageReport::whereNotNull('c1')
            ->whereNotNull('c2')
            ->whereNotNull('c3')
            ->whereNotNull('c4')
            ->whereNotNull('c5')
            ->whereNotNull('c6')
            ->get();

        $criteriaLabels = [
            'c1' => 'Damage Severity',
            'c2' => 'Usage Importance',
            'c3' => 'Safety Concern',
            'c4' => 'Repair Urgency',
            'c5' => 'Impact on Many People',
            'c6' => 'Time to Repair',
        ];

        $results = $this->calculateVikor($reports, $fPlus, $fMinus, $normalized);
        $rankedResults = collect($results)
            ->map(function ($res, $index) use ($reports) {
                return [
                    'nama' => $reports[$index]->facility->facility_name,
                    'Q' => $res['Q'],
                ];
            })
            ->sortBy('Q')
            ->values();

        $pdf = Pdf::loadView('admin.export_pdf', [
            'results' => $results,
            'criteriaLabels' => $criteriaLabels,
            'reports' => $reports,
            'fPlus' => $fPlus,
            'fMinus' => $fMinus,
            'normalized' => $normalized,
            'rankedResults' => $rankedResults,
        ]);

        return $pdf->stream('Repair_Recommendation.pdf');
    }
}

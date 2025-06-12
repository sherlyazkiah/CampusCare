<?php

namespace App\Http\Controllers;

use Dotenv\Util\Str;
use Illuminate\Http\Request;
use App\Models\DamageReport;
use App\Models\Criteria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class TaskController extends Controller
{
    public function index()
    {
        $loggedInUserId = Auth::id();
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


        return view('technician.task', compact('reports', 'c1_scales'));
    }

    public function indexDashboard()
    {
        $loggedInUserId = Auth::id();
        $hasNewReport = DamageReport::where('status', 'In Progress')
            ->where('technician_id', $loggedInUserId)
            ->exists();

        // 🔔 Kirim session flash hanya jika ada laporan baru
        if ($hasNewReport) {
            session()->flash('show_toast', true);
        }
        $taskCount = DamageReport::where('status', 'In Progress')->where('technician_id', $loggedInUserId)->count();
        $processCount = DamageReport::where('status', 'In Progress')->where('technician_id', $loggedInUserId)->count();
        $doneCount = DamageReport::where('status', 'Done')->where('technician_id', $loggedInUserId)->count();
        $c1_scales = Criteria::with('scales')->find(1)?->scales ?? collect();

        $reports = DamageReport::with([
            'user',
            'role',
            'facility',
            'floor',
            'room'
        ])->where('status', 'In Progress')
            ->where('technician_id', $loggedInUserId)
            ->orderBy('damage_report_id', 'asc')
            ->get();

        return view('technician.dashboard', compact('reports', 'c1_scales', 'taskCount', 'processCount', 'doneCount'));
    }
    public function history()
    {
        $loggedInUserId = Auth::id();
        $c1_scales = Criteria::with('scales')->find(1)?->scales ?? collect();
        $reports = DamageReport::with([
            'user',       // reporter
            'role',       // reporter role (e.g. Student/Technician)
            'facility',
            'floor',
            'room'
        ])->where('technician_id', $loggedInUserId) // This is the key: filter by assigned technician_id
            ->where('status', 'Done')
            ->orderBy('damage_report_id', 'asc')
            ->get();
        return view('technician.history', compact('reports', 'c1_scales'));
    }


    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:damage_report,id',
            'completion_photo' => 'required|image|max:2048',
        ]);

        $report = DamageReport::findOrFail($request->task_id);

        // Simpan file foto
        $path = $request->file('completion_photo')->store('completion_photos', 'public');

        // Update laporan
        $report->completion_photo = $path;
        $report->status = 'selesai';
        $report->save();

        return redirect()->route('tasks.index')->with('success', 'Foto penyelesaian berhasil diupload.');
    }

    public function markInProgress($id)
    {
        $report = DamageReport::findOrFail($id);
        $report->status = 'in_progress';
        $report->save();

        return redirect()->back()
            ->with('success', 'Task marked as in progress.')
            ->with('show_toast', true);
        //return redirect()->back()->with('success', 'Task marked as in progress.');
    }

    public function markCompleted(Request $request, $id)
    {
        $request->validate([
            'image_technician' => 'required|image|max:2048',
            'completion_description' => 'nullable|string',
        ]);

        $report = DamageReport::findOrFail($id);

        if ($request->hasFile('image_technician')) {

            if ($report->image_technician && file_exists(public_path($report->image_technician))) {
                unlink(public_path($report->image_technician));
            }

            $filename = time() . '_' . $id . '.' . $request->file('image_technician')->getClientOriginalExtension();

            $request->file('image_technician')->move(public_path('technician'), $filename);

            $report->image_technician = 'technician/' . $filename;
        }

        $report->completion_description = $request->completion_description;
        $report->status = 'Done';
        $report->save();

        return redirect()->route('technician.task')->with('success', 'Task completed and photo uploaded successfully.');
    }
}

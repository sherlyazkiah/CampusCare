<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DamageReport;
use Illuminate\Support\Facades\Storage;


class TaskController extends Controller
{
    public function index()
    {
        $reports = DamageReport::with([
            'user',       // reporter
            'role',       // reporter role (e.g. Student/Technician)
            'facility',
            'floor',
            'room'
        ])->orderBy('damage_report_id', 'asc')->get();


        return view('technician.task', compact('reports'));
    }

    public function indexDashboard()
    {
        $taskCount = DamageReport::where('status', 'pending')->count();
        $processCount = DamageReport::where('status', 'in_progress')->count();
        $doneCount = DamageReport::where('status', 'Repaired')->count();
        $reports = DamageReport::with([
            'user',       // reporter
            'role',       // reporter role (e.g. Student/Technician)
            'facility',
            'floor',
            'room'
        ])->orderBy('damage_report_id', 'asc')->get();


        return view('technician.dashboard', compact('reports', 'taskCount', 'processCount', 'doneCount'));
    }
    public function history()
    {
        $reports = DamageReport::with([
            'user',       // reporter
            'role',       // reporter role (e.g. Student/Technician)
            'facility',
            'floor',
            'room'
        ])->orderBy('damage_report_id', 'asc')->get();

        return view('technician.history', compact('reports'));
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
            'completion_photo' => 'required|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $report = DamageReport::findOrFail($id);

        if ($request->hasFile('completion_photo')) {
            $path = $request->file('completion_photo')->store('completion_photos', 'public');
            $report->completion_photo = $path;
        }

        $report->completion_description = $request->description;
        $report->status = 'completed';
        $report->save();

        return redirect()->back()->with('success', 'Task completed and photo uploaded.');
    }
}
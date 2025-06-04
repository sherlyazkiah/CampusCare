@extends('layouts.technician')

@section('main')
<div class="max-w-7xl mx-auto">

    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Repair Tasks</h1>
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
            <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Facility</th>
                <th class="px-4 py-2 text-left">Location</th>
                <th class="px-4 py-2 text-left">Description</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-left">Action</th>
            </tr>
        </thead>
        <tbody id="tasksBody" class="divide-y divide-gray-200 dark:divide-gray-700">
            <tr data-status="new">
                <td class="px-4 py-2">001</td>
                <td class="px-4 py-2">Projector</td>
                <td class="px-4 py-2">Building C - 3rd Floor</td>
                <td class="px-4 py-2">Not turning on</td>
                <td class="px-4 py-2 status-cell text-red-600 font-semibold capitalize">New</td>
                <td class="px-4 py-2">
                    <button class="status-btn bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Mark In Progress</button>
                </td>
            </tr>
            <tr data-status="in progress">
                <td class="px-4 py-2">002</td>
                <td class="px-4 py-2">Air Conditioner</td>
                <td class="px-4 py-2">Building A - 1st Floor</td>
                <td class="px-4 py-2">Making noise</td>
                <td class="px-4 py-2 status-cell text-yellow-500 font-semibold capitalize">In Progress</td>
                <td class="px-4 py-2">
                    <button class="status-btn bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">Mark Completed</button>
                </td>
            </tr>
            <tr data-status="completed">
                <td class="px-4 py-2">003</td>
                <td class="px-4 py-2">Light</td>
                <td class="px-4 py-2">Building B - 2nd Floor</td>
                <td class="px-4 py-2">Flickering</td>
                <td class="px-4 py-2 status-cell text-green-600 font-semibold capitalize">Completed</td>
                <td class="px-4 py-2 text-green-700 font-semibold">Completed</td>
            </tr>
        </tbody>
    </table>
</div>

</section>

<script>
    // Update stats function
    function updateStats() {
        const rows = document.querySelectorAll('#tasksBody tr');
        let newCount = 0,
            progressCount = 0,
            completeCount = 0;

        rows.forEach(row => {
            const status = row.getAttribute('data-status');
            if (status === 'new') newCount++;
            else if (status === 'in progress') progressCount++;
            else if (status === 'completed') completeCount++;
        });

        // Update counts & colors
        const newCountEl = document.getElementById('newCount');
        const progressCountEl = document.getElementById('progressCount');
        const completeCountEl = document.getElementById('completeCount');

        newCountEl.textContent = newCount;
        progressCountEl.textContent = progressCount;
        completeCountEl.textContent = completeCount;

        // Color logic: if count > 0 green, else red
        newCountEl.className = newCount > 0 ? 'text-green-600 font-bold text-2xl' : 'text-red-500 font-bold text-2xl';
        progressCountEl.className = progressCount > 0 ? 'text-green-600 font-bold text-2xl' : 'text-red-500 font-bold text-2xl';
        completeCountEl.className = completeCount > 0 ? 'text-green-600 font-bold text-2xl' : 'text-red-500 font-bold text-2xl';
    }

    // Button click handler to update status
    function handleStatusChange(e) {
        const btn = e.target;
        if (!btn.classList.contains('status-btn')) return;

        const row = btn.closest('tr');
        let currentStatus = row.getAttribute('data-status');

        if (currentStatus === 'new') {
            // Change to in progress
            row.setAttribute('data-status', 'in progress');
            row.querySelector('.status-cell').textContent = 'In Progress';
            row.querySelector('.status-cell').className = 'px-4 py-2 status-cell text-yellow-500 font-semibold capitalize';
            btn.textContent = 'Mark Completed';
            btn.className = 'status-btn bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded';
        } else if (currentStatus === 'in progress') {
            // Change to completed
            row.setAttribute('data-status', 'completed');
            row.querySelector('.status-cell').textContent = 'Completed';
            row.querySelector('.status-cell').className = 'px-4 py-2 status-cell text-green-600 font-semibold capitalize';
            // Replace button with completed text
            btn.parentElement.innerHTML = '<span class="text-green-600 font-semibold">Completed</span>';
        }

        updateStats();
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateStats();
        document.getElementById('tasksBody').addEventListener('click', handleStatusChange);
    });
</script>
@endsection
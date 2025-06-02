@extends('layouts.technician')

@section('main')
<div class="max-w-7xl mx-auto">

    <!-- Header Section with Export Button -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Repair History</h1>
        <button
            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors duration-200">
            Export Data
            <!-- Document Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 text-white" viewBox="0 0 20 20" fill="currentColor">
                <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.828a2 2 0 00-.586-1.414l-3.828-3.828A2 2 0 0010.172 2H6zm2 6a1 1 0 100 2h4a1 1 0 100-2H8zm0 4a1 1 0 100 2h4a1 1 0 100-2H8z" />
            </svg>
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Facility</th>
                    <th class="px-4 py-2 text-left">Location</th>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                <tr class="bg-white dark:bg-gray-900">
                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100">002</td>
                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100">Classroom AC</td>
                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100">Building B</td>
                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100">2024-05-27</td>
                    <td class="px-4 py-2 text-green-600 dark:text-green-400 font-semibold">Completed</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
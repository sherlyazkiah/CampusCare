@extends('layouts.technician')

@section('main')
<section class="ml-0 text-black dark:text-white">

    <!-- Greeting -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Hi Techniccian</h1>
        <p class="text-gray-600">Welcome Back</p>
    </div>

    <!-- Stats -->
    <div class="mb-5">
        <h4 class="mb-4 text-xl font-bold">Dashboard</h4>
        <div class="flex overflow-x-auto gap-2 pb-2">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 text-center min-w-[150px] flex-1">
                <p class="text-2xl font-bold text-red-500">0</p>
                <p class="text-sm text-gray-500">Task</p>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 text-center min-w-[150px] flex-1">
                <p class="text-2xl font-bold text-red-500">0</p>
                <p class="text-sm text-gray-500">Progress</p>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 text-center min-w-[150px] flex-1">
                <p class="text-2xl font-bold text-red-600">0</p>
                <p class="text-sm text-gray-500">Complate</p>
            </div>
        </div>
    </div>

    <!-- Repair Tasks Table -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Facility</th>
                    <th class="px-4 py-2 text-left">Location</th>
                    <th class="px-4 py-2 text-left">Description</th>
                    <th class="px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody id="tasksBody" class="divide-y divide-gray-200 dark:divide-gray-700">
                <tr data-status="new">
                    <td class="px-4 py-2">001</td>
                    <td class="px-4 py-2">Projector</td>
                    <td class="px-4 py-2">Building C - 3rd Floor</td>
                    <td class="px-4 py-2">Not turning on</td>
                    <td class="px-4 py-2 status-cell text-red-600 font-semibold capitalize">New</td>
                </tr>
                <tr data-status="in progress">
                    <td class="px-4 py-2">002</td>
                    <td class="px-4 py-2">Air Conditioner</td>
                    <td class="px-4 py-2">Building A - 1st Floor</td>
                    <td class="px-4 py-2">Making noise</td>
                    <td class="px-4 py-2 status-cell text-yellow-500 font-semibold capitalize">In Progress</td>
                </tr>
                <tr data-status="completed">
                    <td class="px-4 py-2">003</td>
                    <td class="px-4 py-2">Light</td>
                    <td class="px-4 py-2">Building B - 2nd Floor</td>
                    <td class="px-4 py-2">Flickering</td>
                    <td class="px-4 py-2 status-cell text-green-600 font-semibold capitalize">Completed</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
@endsection
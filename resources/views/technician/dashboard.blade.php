@extends('layouts.technician')

@section('main')
    <div class="px-4 py-8 pb-70 mt-14 sm:ml-64 text-black dark:text-white bg-gray-50 dark:bg-gray-900">

        <!-- Greeting & Notification -->
        <div class="flex items-start justify-between gap-4">
            <div class="mb-6">
                <h1 class="text-2xl font-bold">Hi Technician</h1>
                <p class="text-gray-600">Welcome Back</p>
            </div>
                        @if(session('show_toast'))
                <div id="toast-notif" class="fixed bottom-5 right-5 z-50 flex items-center w-full max-w-xs p-4 text-gray-500 bg-red-100 rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800" role="alert">
                    <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-gray-800 dark:text-red-400">
                        <!-- Warning Icon -->
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5..."/></svg>
                    </div>
                    <div class="ms-3 text-sm font-normal dark:text-red-200">Ada laporan baru dengan status <strong>in progress</strong>.</div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 p-1.5 bg-red-100 text-red-500 rounded-lg hover:bg-red-200 dark:bg-gray-800 dark:hover:bg-gray-700" onclick="document.getElementById('toast-notif').remove();">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                    </button>
                </div>
            @endif
        </div>

        <!-- Banner -->
        <div class="bg-blue-600 text-white rounded-xl p-6 mb-6 flex justify-between items-center shadow-lg transition-shadow duration-300"
            style="background-position: 70% center">
            <div>
                <h2 class="text-xl font-semibold mb-2">Campus Care</h2>
                <p class="mb-4">
                    For Help You To make Comfortable<br />
                    Your Campus Care.
                </p>
            </div>
        </div>

        <div class="grid w-full grid-cols-1 gap-4 xl:grid-cols-2 2xl:grid-cols-3">
            <!-- Card 1 -->
            <div class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
                <div class="text-center min-w-[150px] flex-1">
                    <h5 class="mb-1 leading-none text-2xl font-bold text-red-600 pb-1">{{ $taskCount }}</h5>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Task</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
                <div class="text-center min-w-[150px] flex-1">
                    <h5 class="mb-1 leading-none text-2xl font-bold text-yellow-400 pb-1">{{ $processCount }}</h5>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Progress</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
                <div class="text-center min-w-[150px] flex-1">
                    <h5 class="mb-1 leading-none text-2xl font-bold text-green-600 pb-1">{{ $doneCount }}</h5>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Complete</p>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div
            class="mt-5 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <!-- Card header -->
            <div class="items-center justify-between lg:flex">
                <div class="mb-4 lg:mb-0">
                    <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Task</h3>
                    <span class="text-base font-normal text-gray-500 dark:text-gray-400">This is a list of latest
                        task</span>
                </div>
            </div>
            <!-- Table -->
            <div class="flex flex-col mt-6">
                <div class="overflow-x-auto rounded-lg">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden shadow sm:rounded-lg">
                            <table id="selection-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th
                                            class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            ID
                                        </th>
                                        <th
                                            class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            Reporter
                                        </th>
                                        <th
                                            class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            Facility Name
                                        </th>
                                        <th
                                            class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            Location
                                        </th>
                                        <th
                                            class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            Date & Time
                                        </th>
                                        <th
                                            class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    @foreach ($reports as $report)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                                {{ $report->damage_report_id }}
                                            </td>
                                            <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                                {{ $report->user->username ?? '-' }}
                                            </td>
                                            <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                                {{ $report->facility->facility_name ?? '-' }}
                                            </td>
                                            <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                                {{ $report->floor->floor_name ?? '' }}, {{ $report->room->room_name ?? '' }}
                                            </td>
                                            <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                                {{ $report->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="p-4">
                                                @php
    $statusClass = match ($report->status) {
        'new' => 'bg-red-100 text-red-800 dark:border-red-400 dark:bg-gray-700 dark:text-red-400',
        'in_progress' => 'bg-yellow-100 text-yellow-800 dark:border-yellow-400 dark:bg-gray-700 dark:text-yellow-400',
        'completed' => 'bg-green-100 text-green-800 dark:border-green-400 dark:bg-gray-700 dark:text-green-400',
        default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-white'
    };
                                                  @endphp
                                                <span
                                                    class="text-xs font-medium px-2.5 py-0.5 rounded-md border {{ $statusClass }}">
                                                    {{ ucfirst(str_replace('_', ' ', $report->status)) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="flex items-center justify-between pt-3 sm:pt-6">
                <a href="{{ url('technician/tasks') }}"
                    class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
                    Show All Task
                    <svg class="w-4 h-4 ml-1 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    </div>
@endsection
@extends('layouts.user')

@section('main')
<div class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-gray-50 dark:bg-gray-900">

  <!-- Greeting -->
  <div class="mb-6">
    <h1 class="text-3xl font-bold text-blue-600">
      Hi {{ Auth::user()->username }}
    </h1>
    <p class="text-gray-600">Welcome to Campus Care</p>
  </div>

  <!-- Banner -->
  <div class="bg-blue-600 text-white rounded-xl p-6 mb-6 flex justify-between items-center shadow-lg transition-shadow duration-300" style="background-position: 70% center">
    <div>
      <h2 class="text-xl font-semibold mb-2">Campus Care</h2>
      <p class="mb-4">
        For Help You To make Comfortable<br />
        Your Campus Care.
      </p>
    </div>
      <img
      src="{{ asset('\img\user.svg') }}"
      alt="Campus Care Logo"
      class="w-1/2 h-40 object-contain object-center hidden md:block" />
  </div>

  <!-- Summary Cards -->
  <div class="grid w-full grid-cols-1 gap-4 xl:grid-cols-2 2xl:grid-cols-3">
    <div class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
      <div class="text-center min-w-[150px] flex-1">
        <h5 class="mb-1 leading-none text-2xl font-bold text-red-600 pb-1">{{ $pendingCount }}</h5>
        <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Pending</p>
      </div>
    </div>
    <div class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
      <div class="text-center min-w-[150px] flex-1">
        <h5 class="mb-1 leading-none text-2xl font-bold text-yellow-400 pb-1">{{ $processCount }}</h5>
        <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Process</p>
      </div>
    </div>
    <div class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
      <div class="text-center min-w-[150px] flex-1">
        <h5 class="mb-1 leading-none text-2xl font-bold text-green-600 pb-1">{{ $doneCount }}</h5>
        <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Done</p>
      </div>
    </div>
  </div>

  <!-- Recent Reports Table -->
  <div class="flex flex-col mt-6">
    <div class="overflow-x-auto rounded-lg">
      <div class="inline-block min-w-full align-middle">
        <div class="overflow-hidden shadow sm:rounded-lg">
          <table id="selection-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
            <thead class="bg-gray-100 dark:bg-gray-700">
              <tr>
                <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">No</th>
                <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Name</th>
                <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Facility</th>
                <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Location</th>
                <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Damage Level</th>
                <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Status</th>
                <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Date &amp; Time</th>
              </tr>
            </thead>
            <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
              @forelse ($reports as $report)
              <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 ">
                        {{ $loop->iteration }}
                           </td>
                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $report->user->username ?? '-' }}</td>
                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $report->facility->facility_name ?? '-' }}</td>
                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $report->room->room_name ?? '-' }}, {{ $report->floor->floor_name ?? '-' }}</td>
                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ optional($c1_scales->firstWhere('scale_value', old('c1', $report->c1 ?? '')))->scale_description ?? 'N/A' }}</td>
                <td class="p-4 whitespace-nowrap">
                  <span class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-orange-100 dark:bg-gray-700 dark:border-orange-300 dark:text-orange-300">{{ $report->status }}</span>
                </td>
                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ \Carbon\Carbon::parse($report->damage_date)->format('M d, Y') }}</td>
                <td class="p-4 space-x-2 whitespace-nowrap">
                  
                    
                  
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="8" class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">
                  No reports found.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Table Footer -->
    <div class="flex items-center justify-between pt-3 sm:pt-6">
      <a href="{{ url('user/reports') }}" class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
        Show All Report
        <svg class="w-4 h-4 ml-1 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
      </a>
    </div>
  </div>
</div>
@endsection
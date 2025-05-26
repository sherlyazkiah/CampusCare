@extends('layouts.user')

@section('main')
<section class="ml-0 text-black dark:text-white">

  <!-- Greeting -->
  <div class="mb-6">
    <h1 class="text-2xl font-bold">Hi user</h1>
    <p class="text-gray-600">Welcome To Campus Care</p>
  </div>

  <!-- Banner -->
  <div class="bg-gradient-to-r from-green-600 via-emerald-400 to-teal-300 text-white rounded-xl p-6 mb-6 flex justify-between items-center shadow-lg hover:shadow-xl transition-shadow duration-300" style="background-position: 70% center">
    <div>
      <h2 class="text-xl font-semibold mb-2">Campus Care</h2>
      <p class="mb-4">
        For Help You To make Comfortable<br />
        Your Campus Care.
      </p>
    </div>
    <img
      src="{{ asset('image/logocampus.png') }}"
      alt="Campus Care Logo"
      class="w-1/2 h-32 object-contain object-center hidden md:block" />
  </div>

  <!-- Stats -->
  <!-- Buat color stats nya jika angkanya 0 maka warnanya merah, jika data lebih dari 0 maka warnanya hijau -->
  <div class="mb-5">
    <h4 class="mb-4 text-xl font-bold">Dashboard</h4>
    <div class="flex overflow-x-auto gap-2 pb-2">
      <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 text-center min-w-[150px] flex-1">
        <p class="text-2xl font-bold text-red-500">0</p>
        <p class="text-sm text-gray-500">Verification Admin</p>
      </div>
      <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 text-center min-w-[150px] flex-1">
        <p class="text-2xl font-bold text-red-500">0</p>
        <p class="text-sm text-gray-500">Process</p>
      </div>
      <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 text-center min-w-[150px] flex-1">
        <p class="text-2xl font-bold text-red-600">0</p>
        <p class="text-sm text-gray-500">Done</p>
      </div>
    </div>
  </div>

  <div class="mb-5">
    <h4 class="mb-4 text-xl font-bold">Reports</h4>

    <div class="flex flex-col gap-3">
      @forelse ($reports as $report)
      <div class="w-full rounded-lg border border-gray-200 dark:border-gray-700 p-4 bg-white dark:bg-gray-800 shadow-sm">
        <div class="flex justify-between">
          <!-- text -->
          <div class="flex-grow">
            <h1 class="font-semibold text-gray-900 dark:text-white">{{ $report->title }}</h1>
            <div class="mt-2 space-y-1">
              <p class="text-sm text-gray-500 dark:text-gray-400">
                <span class="font-medium">Nama:</span> {{ $report->name }} -
                <span class="font-medium">NIM:</span> {{ $report->nim }}
              </p>
              <p class="text-sm text-gray-500 dark:text-gray-400">
                <span class="font-medium">Kelas:</span> {{ $report->class }} -
                <span class="font-medium">Lantai:</span> {{ $report->floor }}
              </p>
              <p class="text-sm text-gray-500 dark:text-gray-400">
                <span class="font-medium">Fasilitas:</span> {{ $report->facility }} -
                <span class="font-medium">Tingkat Kerusakan:</span> {{ $report->damage_scale }}
              </p>
              <p class="text-sm text-gray-500 dark:text-gray-400">
                <span class="font-medium">Tanggal:</span> {{ $report->date->format('d M Y') }}
              </p>
            </div>
          </div>

          <!-- action -->
          <div class="flex items-start ml-4">
            <a href="{{ route('user.reports.show', $report->id) }}"
              class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">View</a>
          </div>
        </div>
      </div>
      @empty
      <div class="text-center py-4 text-gray-500 dark:text-gray-400">
        No reports found
      </div>
      @endforelse

      @if ($reports->isNotEmpty())
      <div class="text-center mt-2">
        <a href="{{ route('user.reports.index') }}"
          class="text-blue-500 hover:text-blue-600 transition-colors">View all reports</a>
      </div>
      @endif
    </div>
  </div>
</section>
@endsection
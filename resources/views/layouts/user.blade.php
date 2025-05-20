@extends('layouts.app')

@section('main')
  <!-- Banner -->
  <div class="bg-blue-500 text-white rounded-xl p-6 mb-6 flex justify-between items-center">
    <div>
      <h2 class="text-xl font-semibold mb-2">Need to find a doctor?</h2>
      <p class="mb-4">Go online with us!<br>Get your first medical service at your home.</p>
      <button class="bg-white text-blue-600 font-bold px-4 py-2 rounded shadow hover:bg-gray-100">Book Appointment</button>
    </div>
    <img src="https://www.svgrepo.com/show/427674/doctor-consultation.svg" class="w-40 hidden md:block" alt="Doctor">
  </div>

  <!-- Stats -->
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 text-center">
      <p class="text-2xl font-bold">33</p>
      <p class="text-sm text-gray-500">Total Booking</p>
    </div>
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 text-center">
      <p class="text-2xl font-bold text-green-500">22</p>
      <p class="text-sm text-gray-500">Booking Success</p>
    </div>
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 text-center">
      <p class="text-2xl font-bold text-red-500">12</p>
      <p class="text-sm text-gray-500">Booking Cancel</p>
    </div>
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 text-center">
      <p class="text-2xl font-bold text-green-600">$50</p>
      <p class="text-sm text-gray-500">Paid Amount</p>
    </div>
  </div>
@endsection

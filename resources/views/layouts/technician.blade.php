@extends('layouts.app')
@section('content')

  <!-- Navbar -->
  @include('components.technician.navbar')
  
  <!-- Sidebar -->
  @include('components.technician.sidebar')
  
  <!-- Main -->
  <section class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white">
    @yield('main')
  </section>
@endsection
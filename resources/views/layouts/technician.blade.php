@extends('layouts.app')
@section('content')

  <!-- Navbar -->
  @include('components.technician.navbar')
  
  <!-- Sidebar -->
  @include('components.technician.sidebar')
  
  <!-- Main -->
  <section>
    @yield('main')
  </section>
@endsection
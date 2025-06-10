@extends('layouts.app')
@section('content')

  <!-- Navbar -->
  @include('components.admin.navbar')
  
  <!-- Sidebar -->
  @include('components.admin.sidebar')
  
  <!-- Main -->
  <section>
    @yield('main')
  </section>
@endsection
@extends('layouts.app')
@section('content')

  <!-- Navbar -->
  @include('components.user.navbar')
  
  <!-- Sidebar -->
  @include('components.user.sidebar')
  
  <!-- Main -->
  <section>
    @yield('main')
  </section>
@endsection
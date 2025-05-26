@extends('layouts.app')
@section('content')

  <!-- Navbar -->
  @include('components.user.navbar')
  
  <!-- Sidebar -->
  @include('components.user.sidebar')
  
  <!-- Main -->
  <section class="px-4 py-8 mt-10 sm:ml-56 text-black dark:text-white">
    @yield('main')
  </section>
@endsection
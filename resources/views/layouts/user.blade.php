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
 

  {{-- Tambahkan ini supaya JavaScript bisa tampil --}}
  @stack('scripts')


@endsection
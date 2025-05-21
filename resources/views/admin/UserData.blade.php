@extends('layouts.admin')

@section('main')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
    }

    th, td {
        border: 1px solid #999;
        padding: 8px 12px;
        text-align: left;
    }

    th {
        background-color: #333;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .container {
        max-width: 800px;
        margin: 40px auto;
        font-family: Arial, sans-serif;
    }

    h1 {
        margin-bottom: 20px;
    }
</style>
<div class="container">
    <a href="{{ route('userdata.create') }}">Tambah User</a>
    <h1 class="mb-4">Daftar User</h1>
    

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role->name ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

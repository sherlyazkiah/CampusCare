@extends('layouts.admin')

@section('main')
<div class="max-w-xl mx-auto p-6 bg-white shadow-md rounded-md mt-6">
    <h2 class="text-2xl font-bold mb-4">Tambah Lantai Baru</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('floors.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="floor_number" class="block font-medium">Nomor Lantai</label>
            <input type="number" name="floor_number" id="floor_number"
                class="w-full border border-gray-300 p-2 rounded mt-1"
                value="{{ old('floor_number') }}" required>
        </div>

        <div class="mb-4">
            <label for="floor_name" class="block font-medium">Nama Lantai</label>
            <input type="text" name="floor_name" id="floor_name"
                class="w-full border border-gray-300 p-2 rounded mt-1"
                value="{{ old('floor_name') }}" required>
        </div>

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Simpan
        </button>
        <a href="{{ route('floorroomdata.index') }}"
            class="ml-2 text-gray-600 underline">Kembali</a>
    </form>
</div>
@endsection

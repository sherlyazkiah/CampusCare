@extends('layouts.admin')

@section('main')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Fasilitas</h1>

    {{-- Tombol Tambah Fasilitas --}}
    <a href="{{ route('facilitydata.create') }}" class="inline-block mb-4 px-4 py-2 bg-green-600 text-black rounded hover:bg-green-700">
        + Tambah Fasilitas
    </a>

    {{-- Tabel Fasilitas --}}
    <table class="min-w-full border border-gray-300 bg-white shadow-md rounded-md">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border-b text-left">ID</th>
                <th class="py-2 px-4 border-b text-left">Nama Fasilitas</th>
                <th class="py-2 px-4 border-b text-left">Jumlah</th>
                <th class="py-2 px-4 border-b text-left">Lantai</th>
                <th class="py-2 px-4 border-b text-left">Ruangan</th>
                <th class="py-2 px-4 border-b text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($facilities as $facility)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ $facility->facility_id }}</td>
                    <td class="py-2 px-4 border-b">{{ $facility->facility_name }}</td>
                    <td class="py-2 px-4 border-b">{{ $facility->jumlah }}</td>
                    <td class="py-2 px-4 border-b">{{ $facility->floor->floor_name ?? '-' }}</td>
                    <td class="py-2 px-4 border-b">{{ $facility->room->room_name ?? '-' }}</td>
                    <td class="py-2 px-4 border-b flex space-x-2">
                        <a href="{{ route('facilitydata.edit', $facility->facility_id) }}"
                           class="px-3 py-1 bg-yellow-400 text-black rounded hover:bg-yellow-500">
                            Edit
                        </a>
                        <form action="{{ route('facilitydata.destroy', $facility->facility_id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-black rounded hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">Tidak ada fasilitas yang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

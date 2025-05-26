@extends('layouts.admin')

@section('main')
<div class="container mx-auto p-4">

    {{-- ======= FLOOR TABLE ======= --}}
    <h1 class="text-2xl font-bold mb-4">Daftar Lantai</h1>
    <a href="{{ route('floors.create') }}"
        class="inline-block mb-4 px-4 py-2 bg-green-600 text-black rounded hover:bg-green-700">
        + Tambah Lantai
    </a>

    <table class="min-w-full border border-gray-300 bg-white shadow-md rounded-md mb-8">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border-b text-left">ID</th>
                <th class="py-2 px-4 border-b text-left">Nomor Lantai</th>
                <th class="py-2 px-4 border-b text-left">Nama Lantai</th>
                <th class="py-2 px-4 border-b text-left">Dibuat Pada</th>
                <th class="py-2 px-4 border-b text-left">Aksi</th> {{-- Tambahan --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($floors as $floor)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ $floor->floor_id }}</td>
                    <td class="py-2 px-4 border-b">{{ $floor->floor_number }}</td>
                    <td class="py-2 px-4 border-b">{{ $floor->floor_name }}</td>
                    <td class="py-2 px-4 border-b">{{ $floor->created_at }}</td>
                    <td class="py-2 px-4 border-b flex space-x-2">
                        <a href="{{ route('floors.edit', $floor->floor_id) }}"
                           class="px-3 py-1 bg-yellow-400 text-black rounded hover:bg-yellow-500">
                           Edit
                        </a>
                        <form action="{{ route('floors.destroy', $floor->floor_id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 bg-red-600 text-black rounded hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        
    </table>

    {{-- ======= ROOM TABLE ======= --}}
    
    <h1 class="text-2xl font-bold mb-4">Daftar Ruangan</h1>
    <table class="min-w-full border border-gray-300 bg-white shadow-md rounded-md">
        <a href="{{ route('rooms.create') }}"
        class="inline-block mb-4 px-4 py-2 bg-green-600 text-black rounded hover:bg-green-700">
        + Tambah Ruangan
    </a>
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border-b text-left">ID Ruangan</th>
                <th class="py-2 px-4 border-b text-left">Nama Ruangan</th>
                <th class="py-2 px-4 border-b text-left">Lantai</th>
                <th class="py-2 px-4 border-b text-left">Dibuat Pada</th>
                <th class="py-2 px-4 border-b text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ $room->room_id }}</td>
                    <td class="py-2 px-4 border-b">{{ $room->room_name }}</td>
                    <td class="py-2 px-4 border-b">
                        {{ $room->floor->floor_name ?? 'Tidak Diketahui' }}
                    </td>
                    <td class="py-2 px-4 border-b">{{ $room->created_at }}</td>
                    <td class="py-2 px-4 border-b flex space-x-2">
                        <a href="{{ route('rooms.edit', $room->room_id) }}"
                           class="px-3 py-1 bg-yellow-400 text-black rounded hover:bg-yellow-500">
                           Edit
                        </a>
                        <form action="{{ route('rooms.destroy', $room->room_id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus ruangan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 bg-red-600 text-black rounded hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </td>                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

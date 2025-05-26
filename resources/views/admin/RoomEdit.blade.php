@extends('layouts.admin')

@section('main')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Edit Ruangan</h1>

    <form action="{{ route('rooms.update', $room->room_id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="room_name" class="block font-medium">Nama Ruangan</label>
            <input type="text" name="room_name" id="room_name" value="{{ old('room_name', $room->room_name) }}"
                   class="w-full border border-gray-300 rounded px-3 py-2" required>
            @error('room_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="floor_id" class="block font-medium">Pilih Lantai</label>
            <select name="floor_id" id="floor_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="">-- Pilih Lantai --</option>
                @foreach ($floors as $floor)
                    <option value="{{ $floor->floor_id }}" {{ $room->floor_id == $floor->floor_id ? 'selected' : '' }}>
                        {{ $floor->floor_name }}
                    </option>
                @endforeach
            </select>
            @error('floor_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('floorroomdata.index') }}"
               class="px-4 py-2 bg-gray-300 text-black rounded hover:bg-gray-400">
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Update
            </button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.admin')

@section('main')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Fasilitas</h1>

    <form action="{{ route('facilitydata.update', $facility->facility_id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label>Nama Fasilitas</label>
            <input type="text" name="facility_name" class="w-full border rounded p-2"
                   value="{{ $facility->facility_name }}" required>
        </div>

        <div>
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label>Lantai</label>
            <select name="floor_id" class="w-full border rounded p-2" required>
                @foreach ($floors as $floor)
                    <option value="{{ $floor->floor_id }}" {{ $floor->floor_id == $facility->floor_id ? 'selected' : '' }}>
                        {{ $floor->floor_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Ruangan</label>
            <select name="room_id" class="w-full border rounded p-2" required>
                @foreach ($rooms as $room)
                    <option value="{{ $room->room_id }}" {{ $room->room_id == $facility->room_id ? 'selected' : '' }}>
                        {{ $room->room_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection

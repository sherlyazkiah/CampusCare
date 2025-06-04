@extends('layouts.user')

@section('main')
    <div class="px-8 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-white dark:bg-gray-900">
        <h2 class="text-2xl font-bold mb-6 text-black dark:text-white">Create New Report</h2>

        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">

                <!-- Name & Title -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Facility, Floor, Room -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Facility Name</label>
                        <select name="facility" required
                            class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">-- Select Facility --</option>
                            @foreach ($facilities as $facility)
                                <option value="{{ $facility->facility_id }}" {{ old('facility') == $facility->facility_id ? 'selected' : '' }}>
                                    {{ $facility->facility_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Floor</label>
                        <select name="floor" required
                            class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">-- Select Floor --</option>
                            @foreach ($floors as $floor)
                                <option value="{{ $floor->floor_id }}" {{ old('floor') == $floor->floor_id ? 'selected' : '' }}>
                                    {{ $floor->floor_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Room</label>
                        <select name="room" required
                            class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">-- Select Room --</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->room_id }}" {{ old('room') == $room->room_id ? 'selected' : '' }}>
                                    {{ $room->room_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Damage Level -->
                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Damage Level</label>
                    <select name="damage_level" required
                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">-- Select Damage Level --</option>
                        @foreach ($damageLevels as $key => $label)
                            <option value="{{ $label }}" {{ old('damage_level') == $label ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Damage Description</label>
                    <textarea name="description" rows="4" required
                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description') }}</textarea>
                </div>

                <!-- Date & Image -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Incident Date</label>
                        <input type="date" name="date" value="{{ old('date') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Damage Photo</label>
                        <input type="file" name="image" class="mt-1 block w-full text-gray-700 dark:text-gray-300"
                            accept="image/*">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-800 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
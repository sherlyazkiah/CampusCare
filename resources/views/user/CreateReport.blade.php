@extends('layouts.user')

@section('main')
<div class="px-8 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-white dark:bg-gray-900">
        <h2 class="text-2xl font-bold mb-6 text-black dark:text-white">Create New Report</h2>

        <form>
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                        <input type="text" name="title" class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Facility Name</label>
                        <select name="facility" class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="kursi">Chair</option>
                            <option value="meja">Table</option>
                            <option value="papan_tulis">Whiteboard</option>
                            <option value="ac">Air Conditioner</option>
                            <option value="proyektor">Projector</option>
                            <option value="lainnya">Others</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Floor</label>
                        <select name="floor" class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="1">Floor 5</option>
                            <option value="2">Floor 6</option>
                            <option value="3">Floor 7</option>
                            <option value="4">Floor 8</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Room</label>
                        <select name="room" class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="1">RT 1</option>
                            <option value="2">RT 2</option>
                            <option value="3">LSI 1</option>
                            <option value="4">LSI 2</option>
                        </select>
                    </div>
                </div>

                <!-- Damage Criteria -->
                <div class="mt-6">
                    <div class="flex flex-col space-y-2">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Damage Level</label>
                        <select name="damage_scale" class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="1">1 - Very Minor (Minimal Damage)</option>
                            <option value="2">2 - Minor (Still Functions Well)</option>
                            <option value="3">3 - Moderate (Function Disrupted)</option>
                            <option value="4">4 - Major (Hardly Functions)</option>
                            <option value="5">5 - Severe (Not Usable)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Damage Description</label>
                    <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Incident Date</label>
                        <input type="date" name="date" class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Damage Photo</label>
                        <input type="file" name="image" class="mt-1 block w-full text-gray-700 dark:text-gray-300" accept="image/*">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                </div>
            </div>
        </form>
</div>
@endsection
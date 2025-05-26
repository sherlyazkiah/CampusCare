@extends('layouts.user')

@section('main')
<div class="container mx-auto px-4 py-6" x-data="{ showNotification: false }">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-6 text-black dark:text-white">Create New Report</h2>

        <form action="{{ route('user.reports.store') }}" method="POST" enctype="multipart/form-data"
            @submit.prevent="
                $el.submit();
                showNotification = true;
              ">
            @csrf
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                        <input type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Student ID (NIM)</label>
                        <input type="text" name="nim" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Floor</label>
                        <select name="floor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="1">Floor 1</option>
                            <option value="2">Floor 2</option>
                            <option value="3">Floor 3</option>
                            <option value="4">Floor 4</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Classroom</label>
                        <input type="text" name="class" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Facility</label>
                        <select name="facility" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="kursi">Chair</option>
                            <option value="meja">Table</option>
                            <option value="papan_tulis">Whiteboard</option>
                            <option value="ac">Air Conditioner</option>
                            <option value="proyektor">Projector</option>
                            <option value="lainnya">Others</option>
                        </select>
                    </div>
                </div>

                <!-- Damage Criteria -->
                <div class="mt-6">
                    <div class="flex flex-col space-y-2">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Damage Level</label>
                        <select name="damage_scale" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
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
                    <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Incident Date</label>
                        <input type="date" name="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Damage Photo</label>
                        <input type="file" name="image" class="mt-1 block w-full text-gray-700 dark:text-gray-300" accept="image/*">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Submit Report
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Success Notification Modal -->
    <!-- <div x-show="showNotification"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-lg p-8 max-w-md w-full mx-4">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Report Submitted Successfully!</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Thank you for submitting your report. Our team will follow up shortly.</p>
                <div class="flex justify-center">
                    <button @click="href = '{{ route("user.dashboard") }}'" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Back to Dashboard
                    </button>
                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection

@section('styles')
<style>
    .form-group {
        margin-bottom: 1rem;
    }

    .card {
        margin-top: 2rem;
    }
</style>
@endsection
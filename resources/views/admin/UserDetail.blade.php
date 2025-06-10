@extends('layouts.admin')

@section('main')
<div class="mt-14 sm:ml-64 px-6 py-10 min-h-screen bg-gray-100 dark:bg-gray-900 text-black dark:text-white">
    <div class="max-w-5xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-xl p-8 border border-gray-200 dark:border-gray-700">
    <h2 class="text-3xl font-bold mb-8 text-gray-900 dark:text-white">
        User Detail
    </h2>

    <div class="grid grid-cols-6 gap-6">
        <div class="col-span-6 sm:col-span-3">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIM/NIDN</label>
            <input type="text" readonly value="{{ $user->biodata->id ?? 'User doesnt fill yet' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input type="text" readonly value="{{ $user->biodata->name ?? 'User doesnt fill yet' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
            <input type="text" readonly value="{{ $user->role->name  ?? 'User doesnt fill yet'}}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
            <input type="text" readonly value="{{ $user->username  ?? 'User doesnt fill yet'}}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="text" readonly value="{{ $user->biodata->title  ?? 'User doesnt fill yet' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="text" readonly value="{{ $user->biodata->email  ?? 'User doesnt fill yet' }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
    </div>

    <div class="flex justify-end mt-6">
        <a href="{{ route('userdata.index') }}" class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
            Return
        </a>
    </div>
</div>
@endsection
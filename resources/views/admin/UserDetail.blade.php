@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto my-8 bg-white rounded-lg shadow-sm dark:bg-gray-700 p-6">
    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">
        User Detail
    </h3>

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
            <input type="text" readonly value="{{ $user->role->name }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
            <input type="text" readonly value="{{ $user->username }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="text" readonly value="{{ $user->biodata->title }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="text" readonly value="{{ $user->biodata->email }}" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
    </div>

    <div class="flex justify-end mt-6">
        <a href="{{ route('userdata.index') }}" class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
            Return
        </a>
    </div>
</div>
@endsection

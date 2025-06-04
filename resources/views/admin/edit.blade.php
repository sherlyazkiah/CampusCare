@extends('layouts.admin')

@section('main')

<div class="mt-14 sm:ml-64 px-6 py-10 min-h-screen bg-gray-100 dark:bg-gray-900 text-black dark:text-white">
    <div class="max-w-5xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-xl p-8 border border-gray-200 dark:border-gray-700">
        <h2 class="text-3xl font-bold mb-8 text-gray-900 dark:text-white">Edit User</h2>

        <form action="{{ route('userdata.update', $user->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Username -->
                <div>
                    <label for="username" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required
                        class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400">
                </div>

                <!-- Role -->
                <div>
                    <label for="role_id" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Role</label>
                    <select name="role_id" id="role_id" required
                        class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400">
                        <option disabled>Select role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->role_id }}" {{ $user->role_id == $role->role_id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Password</label>
                    <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak diubah"
                        class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400">
                </div>
            </div>

            <!-- Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="inline-block px-6 py-2.5 bg-blue-700 text-white font-medium text-sm leading-tight rounded-lg shadow-md hover:bg-blue-800 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
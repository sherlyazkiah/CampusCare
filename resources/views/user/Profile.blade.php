@extends('layouts.user')

@section('main')
<div class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-white dark:bg-gray-900">
    <div class="mb-4">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Profile</h1>
    </div>
    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
            @if ($biodata && $biodata->photo_path)
            <img class="w-32 h-32 rounded-full object-cover" id="previewImage" src="{{ asset('photo_profile/' . $biodata->photo_path) }}" alt="Foto Profil">
            @else
            <img class="w-32 h-32 rounded-full object-cover" id="previewImage" src="https://via.placeholder.com/150" alt="Foto Profil">
            @endif
            <div>
                <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Profile picture</h3>
                <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                    JPG, JPEG, PNG. Max size of 2MB
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Upload Button -->
                    <button type="button" onclick="document.getElementById('uploadInput').click()" 
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path>
                            <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
                        </svg>
                        Upload picture
                    </button>
                    <button type="button" class="py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-2">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">General information</h3>
            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="file" id="uploadInput" name="profile_picture" accept="image/*" class="hidden" />
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="identity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID</label>
                        <input type="text" name="identity" id="identity" value="{{ old('identity', $biodata->identity) }}" required
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                      focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="class_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class</label>
                        <select name="class_id" id="class_id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                      focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">- Select Class -</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->class_id }}" {{ (old('class_id', $biodata->class_id) == $class->class_id) ? 'selected' : '' }}>
                                    {{ $class->class_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $biodata->name) }}" required
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                      focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username', $biodata->user->username) }}" required
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                      focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $biodata->email) }}" required
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                      focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>

                    <!-- Password tidak perlu di sini karena ada modal khusus -->
                </div>
                <div class="flex justify-end col-span-6 sm:col-full space-x-3 mt-4">
                    <button type="button" data-modal-target="detail-report-modal" data-modal-show="detail-report-modal"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg bg-green-600 hover:bg-green-800">
                        Change Password
                    </button>
                    <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for change password -->
    <div id="detail-report-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200
                        hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800
                        dark:hover:text-white" data-modal-hide="detail-report-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd"
                         d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0
                         111.414 1.414L11.414 10l4.293 4.293a1 1 0
                         01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0
                         01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                         clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Change Password</h3>
                    <form action="user.profile.password.update" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="old_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Password</label>
                            <input type="password" name="old_password" id="old_password" required
                                   class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                          focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                          dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div>
                            <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                            <input type="password" name="new_password" id="new_password" required
                                   class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                          focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                          dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div>
                            <label for="new_password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                                   class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                          focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                          dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <button type="submit" class="w-full text-white bg-green-600 hover:bg-green-800 focus:ring-4
                                focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5
                                text-center dark:bg-green-500 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

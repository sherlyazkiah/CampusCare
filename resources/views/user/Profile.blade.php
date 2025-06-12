@extends('layouts.user')

@section('main')
<div class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-white dark:bg-gray-900">
    <div class="mb-4">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Profile</h1>
    </div>
    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
            <img id="profilePreview" class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0 object-cover"
                    src="{{ Auth::user()->biodata->photo_path ? asset('photo_profile/' . Auth::user()->biodata->photo_path) : 'https://flowbite-admin-dashboard.vercel.app/images/users/bonnie-green-2x.png' }}"
                    alt="Profile Picture" />
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

                    {{-- ID --}}
                    <div class="col-span-6 sm:col-span-3">
                        <label for="identity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <input type="text" name="identity" id="identity" value="{{ old('identity', $biodata->identity) }}" required
                                class="pl-10 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                        focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                    </div>

                    {{-- Class --}}
                    <div class="col-span-6 sm:col-span-3">
                        <label for="class_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                             <input type="text" name="class_name" id="class_name"
               value="{{ $biodata->class->class_name ?? '-' }}"
               readonly
               class="pl-10 shadow-sm bg-gray-100 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                      block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white cursor-not-allowed">
                        </div>
                    </div>

                    {{-- Name --}}
                    <div class="col-span-6 sm:col-span-3">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 10a4 4 0 100-8 4 4 0 000 8zm-6 7a6 6 0 0112 0H4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="name" id="name" value="{{ old('name', $biodata->name) }}" required
                                class="pl-10 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                        focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                    </div>

                    {{-- Username --}}
                    <div class="col-span-6 sm:col-span-3">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <input type="text" name="username" id="username" value="{{ old('username', $biodata->user->username) }}" required
                                class="pl-10 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                        focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M2.038 5.61A2.01 2.01 0 0 0 2 6v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6c0-.12-.01-.238-.03-.352l-.866.65-7.89 6.032a2 2 0 0 1-2.429 0L2.884 6.288l-.846-.677Z"/>
                                    <path d="M20.677 4.117A1.996 1.996 0 0 0 20 4H4c-.225 0-.44.037-.642.105l.758.607L12 10.742 19.9 4.7l.777-.583Z"/>
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email', $biodata->email) }}" required
                                class="pl-10 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                        focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                    </div>

                    <!-- Password (readonly) -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <input type="password" id="password" readonly value=""
                                class="pl-10 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                        </div>
                    </div>
                </div>

                <div class="flex justify-end col-span-6 sm:col-full space-x-3 mt-4">
                    <button type="button" data-modal-target="detail-report-modal" data-modal-show="detail-report-modal"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg bg-green-600 hover:bg-green-800">
                        Change Password
                    </button>
                    <button type="submit" id="saveButton" disabled class="px-4 py-2 text-sm font-medium text-white bg-gray-400 rounded-lg 
                        cursor-not-allowed hover:bg-gray-500 focus:outline-none 
                        dark:bg-gray-600 dark:hover:bg-gray-500 dark:cursor-not-allowed transition">
                        Save all
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
                                          {{-- Error tampil di sini --}}
                                            @error('new_password')
                                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
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
<script>
    const uploadInput = document.getElementById('uploadInput');
    const profilePreview = document.getElementById('profilePreview');
    const saveButton = document.getElementById('saveButton');
    const deletePhotoButton = document.getElementById('deletePhotoButton');
    const formInputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="file"]');

    // Preview image after selecting file
    uploadInput.addEventListener('change', () => {
        const file = uploadInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                profilePreview.src = e.target.result;
            }
            reader.readAsDataURL(file);
            checkFormChanges();
        }
    });

    // Enable save button if any form input changed
    formInputs.forEach(input => {
        input.addEventListener('input', checkFormChanges);
    });

    // Function to enable/disable Save button
    function checkFormChanges() {
        let hasChange = false;
        formInputs.forEach(input => {
            if (input.type === 'file') {
                if (input.files.length > 0) hasChange = true;
            } else {
                if (input.value.trim() !== '') hasChange = true;
            }
        });
        saveButton.disabled = !hasChange;
        if (hasChange) {
            saveButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
            saveButton.classList.add('bg-blue-600', 'hover:bg-blue-700', 'cursor-pointer');
        } else {
            saveButton.classList.add('bg-gray-400', 'cursor-not-allowed');
            saveButton.classList.remove('bg-blue-600', 'hover:bg-blue-700', 'cursor-pointer');
        }
    }

    // Delete photo placeholder
    deletePhotoButton.addEventListener('click', () => {
        profilePreview.src = 'https://flowbite-admin-dashboard.vercel.app/images/users/bonnie-green-2x.png';
        uploadInput.value = '';
        checkFormChanges();

        alert('Photo deletion function not implemented. Implement backend logic to handle photo deletion.');
    });

    // Modal open/close
    function openModal() {
        document.getElementById('passwordModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('passwordModal').classList.add('hidden');
    }
</script>
@endsection
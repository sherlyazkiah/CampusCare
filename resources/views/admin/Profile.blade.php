@extends('layouts.admin')

@section('main')
<div class="px-4 py-8 mt-14 sm:ml-64 text-black dark:text-white bg-white dark:bg-gray-900">
    <div class="mb-4">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Profile</h1>
    </div>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
                <img id="profilePreview" class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0 object-cover"
                    src="{{ Auth::user()->biodata->photo_path ? asset('photo_profile/' . Auth::user()->biodata->photo_path) : 'https://flowbite-admin-dashboard.vercel.app/images/users/bonnie-green-2x.png' }}"
                    alt="Profile Picture" />

                <div>
                    <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Profile picture</h3>
                    <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">JPG, JPEG, PNG. Max size of 2MB</div>
                    <div class="flex items-center space-x-4">
                        <input type="file" id="uploadInput" name="photo_path" accept="image/*" class="hidden" />
                        <button type="button" onclick="document.getElementById('uploadInput').click()"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Upload picture
                        </button>
                        <button type="button" id="deletePhotoButton"
                            class="py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- General Information Section -->
        <div class="col-span-2">
            <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">General information</h3>

                <div class="grid grid-cols-6 gap-6">
                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name"
                            value="{{ old('name', Auth::user()->biodata->name ?? '') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                            focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white
                            dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>

                    <!-- Username -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" name="username" id="username"
                            value="{{ old('username', Auth::user()->username) }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                            focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white
                            dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>

                    <!-- Email -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email"
                            value="{{ old('email', Auth::user()->biodata->email ?? '') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                            focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white
                            dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>

                    <!-- Password (readonly) -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" id="password" readonly value="********" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                            block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>
                </div>

                <!-- Save Button -->
                <div class="flex justify-end mt-6 space-x-3">
                    <button type="button" onclick="openModal()"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white rounded-lg bg-green-600 hover:bg-green-800">
                        Change Password
                    </button>
                    <button type="submit" id="saveButton" disabled class="px-4 py-2 text-sm font-medium text-white bg-gray-400 rounded-lg 
                        cursor-not-allowed hover:bg-gray-500 focus:outline-none 
                        dark:bg-gray-600 dark:hover:bg-gray-500 dark:cursor-not-allowed transition">
                        Save all
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Password Modal -->
    <div id="passwordModal" class="hidden fixed top-0 left-0 right-0 inset-0 z-50 flex items-center justify-center bg-black/70">
        <div class="relative w-full max-w-2xl max-h-full ">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-lg w-full p-6 relative">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">Change Password</h3>
                <!-- Close Button -->
                <button onclick="closeModal()"
                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 dark:hover:text-white">
                    ✕
                </button>
                <form method="POST" action="{{ route('profile.password.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-6 gap-6">
                        <!-- Current Password -->
                        <div class="col-span-6 sm:col-span-6">
                            <label for="current_password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>

                        <!-- New Password -->
                        <div class="col-span-6 sm:col-span-6">
                            <label for="new_password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="col-span-6 sm:col-span-6">
                            <label for="new_password_confirmation"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                                dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                    </div>

                    <!-- Save Password Button -->
                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition">
                            Save Password
                        </button>
                    </div>
                </form>
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

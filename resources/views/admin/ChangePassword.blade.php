<div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <h3 class="mb-4 text-xl font-semibold dark:text-white">Change Password</h3>
    <form method="POST" action="{{ route('profile.password.update') }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-6 gap-6">
            <!-- Current Password -->
            <div class="col-span-6 sm:col-span-3">
                <label for="current_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Password</label>
                <input type="password" name="current_password" id="current_password"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                    focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white
                    dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
            </div>

            <!-- New Password -->
            <div class="col-span-6 sm:col-span-3">
                <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                <input type="password" name="new_password" id="new_password"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                    focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white
                    dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
            </div>

            <!-- Confirm New Password -->
            <div class="col-span-6 sm:col-span-3">
                <label for="new_password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                    focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white
                    dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end mt-6">
            <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg 
                hover:bg-blue-700 focus:outline-none transition dark:bg-blue-500 dark:hover:bg-blue-600">
                Update Password
            </button>
        </div>
    </form>
</div>

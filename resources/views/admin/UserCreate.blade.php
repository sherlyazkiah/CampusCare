@extends('layouts.admin')

@section('main')
<div class="w-full min-h-screen overflow-y-auto bg-white dark:bg-gray-800 px-4 pt-24 pb-6">

    <h1 class="text-3xl font-semibold mb-6 text-gray-800 dark:text-gray-100 text-center">Tambah User</h1>

    <form id="userForm" class="w-full max-w-xl mx-auto space-y-4">
        @csrf
        <div>
            <label for="username" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600" >
        </div>

        <div>
            <label for="password" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600" >
        </div>

        <div>
            <label for="role_id" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Role</label>
            <select id="role_id" name="role_id" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                <option value="">- Pilih Role -</option>
                @foreach($roles as $role)
                <option value="{{ $role->role_id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition duration-200">
            Simpan
        </button>
    </form>

    <div id="message" class="mt-4 text-center text-sm"></div>

    <script>
        document.getElementById('userForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const data = new FormData(form);

            fetch("{{ route('userdata.store') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
                },
                body: data
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                const messageEl = document.getElementById('message');
                messageEl.textContent = 'User berhasil ditambahkan!';
                messageEl.className = 'mt-4 text-green-600 font-medium';
                form.reset();
            })
            .catch(error => {
                const messageEl = document.getElementById('message');
                messageEl.textContent = 'Terjadi kesalahan saat menambahkan user.';
                messageEl.className = 'mt-4 text-red-600 font-medium';
                console.error("Gagal:", error);
            });
        });
    </script>
</div>
@endsection

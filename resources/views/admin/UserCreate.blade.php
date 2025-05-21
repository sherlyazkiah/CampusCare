@extends('layouts.admin')

@section('main')
<div class="container mt-4">
    <h1>Tambah User</h1>

    <form id="userForm">
        @csrf
        <input type="text" name="username" placeholder="Username"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <select name="role_id">
            <option value="">- Pilih Role -</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select><br>
        <button type="submit">Simpan</button>
    </form>

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
            .then(response => response.json())
            .then(data => {
                console.log("Sukses:", data);
                form.reset();
            })
            .catch(error => {
                console.error("Gagal:", error);
            });
        });
    </script>
</div>
@endsection

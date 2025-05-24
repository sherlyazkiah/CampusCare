@extends('layouts.admin')

@section('main')
<div class="container">
    <h1>Edit User</h1>

    <form action="{{ route('userdata.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required>
        </div>

        <div>
            <label for="role_id">Role:</label>
            <select name="role_id" id="role_id" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Simpan</button>
    </form>
</div>
@endsection

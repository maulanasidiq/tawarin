@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit User</h1>

<form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block mb-1 font-medium">Nama</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}"
            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400">
    </div>

    <div>
        <label class="block mb-1 font-medium">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}"
            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400">
    </div>

    <div>
        <label class="block mb-1 font-medium">Password (kosongkan jika tidak ingin diubah)</label>
        <input type="password" name="password"
            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400">
    </div>

    <div>
        <label class="block mb-1 font-medium">Role</label>
        <select name="role" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400">
            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
    </div>

    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">
        💾 Simpan Perubahan
    </button>
</form>
@endsection
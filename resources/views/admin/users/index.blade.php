@extends('layouts.admin')

@section('title', 'Kelola User')

@section('content')
<h1 class="text-2xl font-bold mb-6">Kelola User</h1>

@if(session('success'))
<div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
    {{ session('success') }}
</div>
@endif

<!-- 🔍 Search & Filter -->
<form method="GET" action="{{ route('admin.users.index') }}" class="mb-6 flex flex-col md:flex-row gap-3">
    <input type="text" name="search" value="{{ request('search') }}"
        placeholder="Cari user..."
        class="flex-1 px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">

    <select name="role" class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        <option value="">Semua Role</option>
        <option value="admin" {{ request('role')=='admin' ? 'selected' : '' }}>Admin</option>
        <option value="user" {{ request('role')=='user' ? 'selected' : '' }}>User</option>
    </select>

    <button type="submit"
        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
        Filter
    </button>
</form>

<!-- Grid User -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($users as $user)
    <div class="bg-white shadow rounded-lg p-5 flex flex-col justify-between">
        <div>
            <h2 class="text-lg font-bold text-gray-800">{{ $user->name }}</h2>
            <p class="text-sm text-gray-500">{{ $user->email }}</p>
            <span class="mt-2 inline-block px-3 py-1 text-xs rounded 
                {{ $user->role === 'admin' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600' }}">
                {{ ucfirst($user->role) }}
            </span>
        </div>

        <div class="mt-4 flex space-x-2">
            <a href="{{ route('admin.users.edit', $user) }}"
                class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-white text-center py-1 rounded text-sm">
                ✏️ Edit
            </a>
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                onsubmit="return confirm('Yakin hapus user ini?')" class="flex-1">
                @csrf @method('DELETE')
                <button type="submit"
                    class="w-full bg-red-500 hover:bg-red-600 text-white py-1 rounded text-sm">
                    🗑️ Hapus
                </button>
            </form>
        </div>
    </div>
    @empty
    <p class="text-gray-500">Tidak ada user ditemukan.</p>
    @endforelse
</div>

<div class="mt-6">
    {{ $users->appends(request()->query())->links() }}
</div>
@endsection
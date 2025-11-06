@extends('layouts.admin')

@section('title', 'Kelola Tawaran')

@section('content')
<h1 class="text-2xl font-bold mb-6">Kelola Tawaran</h1>

{{-- 🔔 Flash Message --}}
@if (session('success'))
<div class="mb-4 p-3 rounded bg-green-100 text-green-700 border border-green-300">
    ✅ {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="mb-4 p-3 rounded bg-red-100 text-red-700 border border-red-300">
    ⚠️ {{ session('error') }}
</div>
@endif

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                <th class="p-3">User</th>
                <th class="p-3">Lelang</th>
                <th class="p-3">Nominal</th>
                <th class="p-3">Tanggal</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bids as $bid)
            <tr class="border-t hover:bg-gray-50 transition">
                <td class="p-3 font-medium">{{ $bid->user->name }}</td>
                <td class="p-3">{{ $bid->auction->title }}</td>
                <td class="p-3">
                    <span
                        class="px-2 py-1 bg-green-100 text-green-700 rounded text-sm font-semibold">
                        Rp {{ number_format($bid->amount, 0, ',', '.') }}
                    </span>
                </td>
                <td class="p-3 text-gray-600">
                    {{ $bid->created_at->format('d M Y H:i') }}
                </td>
                <td class="p-3 text-center">
                    <form action="{{ route('admin.bids.destroy', $bid->id) }}" method="POST"
                        onsubmit="return confirm('Yakin hapus tawaran ini?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-sm transition flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-3 text-center text-gray-500">
                    Belum ada tawaran
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $bids->links() }}
</div>
@endsection
@extends('layouts.admin')

@section('title', 'Kelola Lelang')

@section('content')
<h1 class="text-2xl font-bold mb-6">Kelola Lelang</h1>

{{-- Flash Message --}}
@if(session('success'))
<div class="mb-4 p-3 rounded bg-green-100 text-green-700 border border-green-300">
    ✅ {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-4 p-3 rounded bg-red-100 text-red-700 border border-red-300">
    ⚠️ {{ session('error') }}
</div>
@endif

{{-- Tombol Tambah --}}
<a href="{{ route('admin.auctions.create') }}"
    class="mb-6 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
    ➕ Tambah Lelang
</a>

{{-- Daftar Lelang --}}
@if($auctions->count())
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($auctions as $auction)
    <div class="bg-white shadow hover:shadow-lg transition rounded-lg overflow-hidden flex flex-col">
        @php
        $firstImage = $auction->images->first();
        @endphp

        <img src="{{ $firstImage ? asset('storage/' . $firstImage->image_path) : 'https://via.placeholder.com/300x200' }}"
            class="w-full h-40 object-cover">

        <div class="p-4 flex flex-col flex-grow">
            <h3 class="text-lg font-bold text-gray-800">{{ $auction->title }}</h3>
            <p class="text-gray-500 text-sm mb-2">
                Rp {{ number_format($auction->starting_price, 0, ',', '.') }}
            </p>
            <span class="text-xs px-2 py-1 rounded self-start
                {{ $auction->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ ucfirst($auction->status) }}
            </span>

            <div class="mt-4 flex space-x-2">
                @if ($auction->status === 'active')
                <a href="{{ route('admin.auctions.edit', $auction->id) }}"
                    class="flex-1 text-center bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-sm transition">
                    ✏️ Edit
                </a>
                @else
                <button disabled
                    class="flex-1 text-center bg-gray-300 text-gray-600 px-3 py-2 rounded text-sm cursor-not-allowed">
                    🚫 Edit Nonaktif
                </button>
                @endif
                <form action="{{ route('admin.auctions.destroy', $auction->id) }}" method="POST"
                    onsubmit="return confirm('Yakin hapus lelang ini?')" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm">
                        🗑 Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="p-6 bg-white rounded-lg shadow text-center text-gray-500">
    🚫 Belum ada lelang yang tersedia.
</div>
@endif
@endsection
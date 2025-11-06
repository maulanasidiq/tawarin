@extends('layouts.admin')

@section('title', 'Edit Lelang')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Lelang</h1>

<form action="{{ route('admin.auctions.update', $auction) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf @method('PUT')

    <div>
        <label class="block mb-1 font-medium">Judul</label>
        <input type="text" name="title" value="{{ old('title', $auction->title) }}"
            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400">
    </div>

    <div>
        <label class="block mb-1 font-medium">Deskripsi</label>
        <textarea name="description" rows="4"
            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400">{{ old('description', $auction->description) }}</textarea>
    </div>

    <div>
        <label class="block mb-1 font-medium">Harga Awal</label>
        <input type="number" name="starting_price" value="{{ old('starting_price', $auction->starting_price) }}"
            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400">
    </div>

    <div>
        <label class="block mb-1 font-medium">Tanggal Mulai</label>
        <input type="datetime-local" name="start_time"
            value="{{ old('start_time', \Carbon\Carbon::parse($auction->start_time)->format('Y-m-d\TH:i')) }}"
            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400">
    </div>

    <div>
        <label class="block mb-1 font-medium">Tanggal Selesai</label>
        <input type="datetime-local" name="end_time"
            value="{{ old('end_time', \Carbon\Carbon::parse($auction->end_time)->format('Y-m-d\TH:i')) }}"
            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400">
    </div>

    <div>
        <label class="block mb-1 font-medium">Gambar</label>
        <input type="file" name="image" accept="image/*"
            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400">

        @if($auction->image)
        <div class="mt-2">
            <p class="text-sm text-gray-600 mb-1">Gambar saat ini:</p>
            <img src="{{ asset('storage/'.$auction->image) }}" alt="Gambar Lelang" class="w-40 rounded shadow">
        </div>
        @endif
    </div>

    <div>
        <label class="block mb-1 font-medium">Status Lelang</label>
        <select name="status" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400">
            <option value="active" {{ $auction->status === 'active' ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ $auction->status === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
            <option value="closed" {{ $auction->status === 'closed' ? 'selected' : '' }}>Ditutup</option>
        </select>
    </div>


    <button type="submit"
        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">
        💾 Simpan Perubahan
    </button>

    @if ($auction->status !== 'closed')
    <form action="{{ route('admin.auctions.update', $auction->id) }}" method="POST" class="inline">
        @csrf @method('PUT')
        <input type="hidden" name="status" value="closed">
        <button type="submit"
            class="ml-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded transition">
            🔒 Tutup Lelang
        </button>
    </form>
    @endif

</form>
@endsection
@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')
<h1 class="text-2xl font-bold mb-6">Laporan Sistem</h1>

<!-- Filter Form -->
<form method="GET" action="{{ route('admin.reports.index') }}" class="flex flex-wrap gap-3 mb-6">
    <div>
        <label class="block text-sm text-gray-600">Dari Tanggal</label>
        <input type="date" name="start_date" value="{{ request('start_date') }}"
            class="border p-2 rounded w-48">
    </div>
    <div>
        <label class="block text-sm text-gray-600">Sampai Tanggal</label>
        <input type="date" name="end_date" value="{{ request('end_date') }}"
            class="border p-2 rounded w-48">
    </div>
    <div class="flex items-end">
        <button type="submit"
            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow transition">
            🔍 Filter
        </button>
    </div>
</form>

<!-- Periode Info -->
@if(request('start_date') && request('end_date'))
<div class="mb-6 p-4 bg-gray-100 border rounded-lg">
    <p class="text-sm text-gray-700">
        <strong>Periode:</strong>
        {{ \Carbon\Carbon::parse(request('start_date'))->format('d M Y') }}
        -
        {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }}
    </p>
</div>
@endif

<!-- Action Buttons -->
<div class="flex flex-wrap gap-3 mb-6">
    <a href="{{ route('admin.reports.exportExcel', request()->only(['start_date','end_date'])) }}"
        class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow transition">
        📊 Export Excel
    </a>
    <a href="{{ route('admin.reports.exportPdf', request()->only(['start_date','end_date'])) }}"
        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow transition">
        📄 Export PDF
    </a>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-500">
        <h2 class="text-lg font-semibold text-gray-600">Total Pengguna</h2>
        <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalUsers }}</p>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-500">
        <h2 class="text-lg font-semibold text-gray-600">Total Lelang</h2>
        <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalAuctions }}</p>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-yellow-500">
        <h2 class="text-lg font-semibold text-gray-600">Total Tawaran</h2>
        <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $totalBids }}</p>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-red-500">
        <h2 class="text-lg font-semibold text-gray-600">Total Nominal Tawaran</h2>
        <p class="text-3xl font-bold text-red-600 mt-2">
            Rp {{ number_format($totalBidAmount, 0, ',', '.') }}
        </p>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Card: Total User -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 rounded-xl shadow text-white">
        <h2 class="text-3xl font-bold">{{ $totalUsers ?? 0 }}</h2>
        <p class="mt-2">Total User</p>
    </div>

    <!-- Card: Total Lelang -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 rounded-xl shadow text-white">
        <h2 class="text-3xl font-bold">{{ $totalAuctions ?? 0 }}</h2>
        <p class="mt-2">Total Lelang</p>
    </div>

    <!-- Card: T@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Card: Total User -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 rounded-xl shadow text-white">
        <h2 class="text-3xl font-bold">{{ $totalUsers ?? 0 }}</h2>
        <p class="mt-2">Total User</p>
    </div>

    <!-- Card: Total Lelang -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 rounded-xl shadow text-white">
        <h2 class="text-3xl font-bold">{{ $totalAuctions ?? 0 }}</h2>
        <p class="mt-2">Total Lelang</p>
    </div>

    <!-- Card: Total Tawaran -->
    <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6 rounded-xl shadow text-white">
        <h2 class="text-3xl font-bold">{{ $totalBids ?? 0 }}</h2>
        <p class="mt-2">Total Tawaran</p>
    </div>
</div>

<!-- Aktivitas Terbaru -->
<div class="bg-white p-6 rounded-xl shadow mt-8">
    <h3 class="text-lg font-semibold mb-4">Aktivitas Terbaru</h3>
    <ul class="divide-y divide-gray-200">
        @forelse($recentActivities ?? [] as $activity)
        <li class="py-3 flex justify-between items-center">
            <div>
                <p class="text-gray-700 font-medium">{{ $activity->description }}</p>
                <p class="text-sm text-gray-400">{{ $activity->created_at->diffForHumans() }}</p>
            </div>
        </li>
        @empty
        <li class="py-3 text-gray-400 text-center">Belum ada aktivitas terbaru.</li>
        @endforelse
    </ul>
</div>

<!-- Ringkasan -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
    <div class="bg-gradient-to-r from-pink-500 to-pink-600 p-6 rounded-xl shadow text-white">
        <h3 class="text-lg font-semibold mb-2">Lelang Aktif</h3>
        <p class="text-2xl font-bold">{{ $activeAuctions ?? 0 }}</p>
    </div>
    <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 p-6 rounded-xl shadow text-white">
        <h3 class="text-lg font-semibold mb-2">User Baru Bulan Ini</h3>
        <p class="text-2xl font-bold">{{ $newUsersThisMonth ?? 0 }}</p>
    </div>
</div>

<!-- Ringkasan Lanjutan -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
    <!-- Lelang Berakhir Hari Ini -->
    <div class="bg-gradient-to-r from-red-500 to-red-600 p-6 rounded-xl shadow text-white">
        <h3 class="text-lg font-semibold mb-2">Lelang Berakhir Hari Ini</h3>
        <p class="text-2xl font-bold">{{ $endingToday ?? 0 }}</p>
    </div>

    <!-- Top 3 User Teraktif -->
    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 p-6 rounded-xl shadow text-white">
        <h3 class="text-lg font-semibold mb-2">Top 3 User Teraktif</h3>
        <ul class="text-sm mt-2 space-y-1">
            @forelse($topUsers ?? [] as $user)
            <li>{{ $user->user->name ?? 'Unknown' }} ({{ $user->total_bids }} tawaran)</li>
            @empty
            <li>Tidak ada data</li>
            @endforelse
        </ul>
    </div>

    <!-- Top 3 Tawaran Tertinggi -->
    <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-6 rounded-xl shadow text-white">
        <h3 class="text-lg font-semibold mb-2">Top 3 Tawaran Tertinggi</h3>
        <ul class="text-sm mt-2 space-y-1">
            @forelse($highestBids ?? [] as $bid)
            <li>{{ $bid->user->name ?? 'Unknown' }} - Rp {{ number_format($bid->amount, 0, ',', '.') }}
                ({{ $bid->auction->title }})
            </li>
            @empty
            <li>Tidak ada data</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
otal Tawaran -->
<div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6 rounded-xl shadow text-white">
    <h2 class="text-3xl font-bold">{{ $totalBids ?? 0 }}</h2>
    <p class="mt-2">Total Tawaran</p>
</div>
</div>

<!-- Aktivitas Terbaru -->
<div class="bg-white p-6 rounded-xl shadow mt-8">
    <h3 class="text-lg font-semibold mb-4">Aktivitas Terbaru</h3>
    <ul class="divide-y divide-gray-200">
        @forelse($recentActivities ?? [] as $activity)
        <li class="py-3 flex justify-between items-center">
            <div>
                <p class="text-gray-700 font-medium">{{ $activity->description }}</p>
                <p class="text-sm text-gray-400">{{ $activity->created_at->diffForHumans() }}</p>
            </div>
        </li>
        @empty
        <li class="py-3 text-gray-400 text-center">Belum ada aktivitas terbaru.</li>
        @endforelse
    </ul>
</div>

<!-- Ringkasan -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold mb-2">Lelang Aktif</h3>
        <p class="text-2xl font-bold text-green-600">{{ $activeAuctions ?? 0 }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold mb-2">User Baru Bulan Ini</h3>
        <p class="text-2xl font-bold text-blue-600">{{ $newUsersThisMonth ?? 0 }}</p>
    </div>
</div>
@endsection
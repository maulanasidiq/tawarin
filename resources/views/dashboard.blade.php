<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-2xl shadow-lg p-8">
                <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }} 👋</h1>
                <p class="text-lg opacity-90">Mulai ikuti lelang atau kelola barangmu di Tawarin.</p>
            </div>

            <!-- Statistik Ringkas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow text-center">
                    <h2 class="text-3xl font-bold text-blue-600">{{ $activeAuctions ?? 0 }}</h2>
                    <p class="text-gray-500 mt-2">Lelang Aktif</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow text-center">
                    <h2 class="text-3xl font-bold text-green-600">{{ $myBids ?? 0 }}</h2>
                    <p class="text-gray-500 mt-2">Tawaran Saya</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow text-center">
                    <h2 class="text-3xl font-bold text-purple-600">{{ $wonAuctions ?? 0 }}</h2>
                    <p class="text-gray-500 mt-2">Menang Lelang</p>
                </div>
            </div>

            <!-- Menu Cepat -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <a href="{{ route('auctions.index') }}"
                    class="p-4 bg-blue-50 hover:bg-blue-100 rounded-lg text-blue-700 font-medium text-center">
                    🔎 Lihat Lelang
                </a>
                <a href="{{ route('auctions.create') }}"
                    class="p-4 bg-green-50 hover:bg-green-100 rounded-lg text-green-700 font-medium text-center">
                    ➕ Tambah Barang
                </a>
                <a href="{{ route('user.bids.index') }}"
                    class="p-4 bg-purple-50 hover:bg-purple-100 rounded-lg text-purple-700 font-medium text-center">
                    📊 Riwayat Tawaran
                </a>
                <a href="{{ route('user.auctions.won') }}"
                    class="p-4 bg-indigo-50 hover:bg-indigo-100 rounded-lg text-indigo-700 font-medium text-center">
                    🏆 Lelang Dimenangkan
                </a>
                <a href="{{ route('notifications.index') }}"
                    class="p-4 bg-yellow-50 hover:bg-yellow-100 rounded-lg text-yellow-700 font-medium text-center">
                    🔔 Notifikasi
                    @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="ml-1 text-xs bg-red-500 text-white rounded-full px-2">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                    @endif
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
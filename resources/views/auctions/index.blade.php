<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Lelang') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Filter & Sort -->
            <div
                class="bg-white p-4 rounded-xl shadow mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <form method="GET" action="{{ route('auctions.index') }}" class="flex items-center gap-3">
                    <label for="sort" class="text-sm text-gray-600">Urutkan:</label>
                    <select name="sort" id="sort"
                        class="rounded-lg border-gray-300 focus:ring focus:ring-blue-200 text-sm"
                        onchange="this.form.submit()">
                        <option value="">Terbaru</option>
                        <option value="lowest_price" {{ request('sort') == 'lowest_price' ? 'selected' : '' }}>
                            Harga Terendah
                        </option>
                        <option value="highest_price" {{ request('sort') == 'highest_price' ? 'selected' : '' }}>
                            Harga Tertinggi
                        </option>
                        <option value="ending_soon" {{ request('sort') == 'ending_soon' ? 'selected' : '' }}>
                            Segera Berakhir
                        </option>
                    </select>
                </form>

                <div>
                    <span class="text-sm text-gray-500">Total: {{ $auctions->total() }} barang</span>
                </div>
            </div>

            <!-- Grid Lelang -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($auctions as $auction)
                @php
                $isOwner = auth()->check() && $auction->user_id === auth()->id();
                $endingSoon = \Carbon\Carbon::parse($auction->end_time)->diffInMinutes(now()) < 60;
                    @endphp

                    <div
                    class="bg-white shadow rounded-xl p-5 hover:shadow-lg transition relative border border-gray-100 dark:border-gray-800">

                    <!-- Badge -->
                    @if ($isOwner)
                    <span
                        class="absolute top-3 right-3 flex items-center gap-1 
                                    text-xs font-medium bg-blue-100 text-blue-700 
                                    dark:bg-blue-800 dark:text-blue-100 
                                    px-2 py-1 rounded-full shadow-sm border border-blue-200 dark:border-blue-700">
                        🏷️ Barang Milik Saya
                    </span>
                    @elseif($endingSoon)
                    <span
                        class="absolute top-3 right-3 bg-red-500 text-white text-xs px-2 py-1 rounded-full animate-pulse">
                        ⏰ Segera Berakhir
                    </span>
                    @endif

                    <!-- Judul & Deskripsi -->
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">{{ $auction->title }}</h3>
                    <p class="text-gray-500 text-sm mb-3 line-clamp-2">{{ $auction->description }}</p>

                    <!-- Harga -->
                    <p class="text-blue-600 font-bold">
                        Rp {{ number_format($auction->current_price, 0, ',', '.') }}
                    </p>
                    <p class="text-sm text-gray-500">
                        Berakhir: {{ \Carbon\Carbon::parse($auction->end_time)->format('d M Y H:i') }}
                    </p>

                    <!-- Tombol Detail -->
                    <a href="{{ route('auctions.show', $auction->id) }}"
                        class="mt-4 inline-block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                        🔎 Lihat Detail
                    </a>

                    <!-- Tombol tawar (hanya kalau bukan pemilik) -->
                    @if (!$isOwner)
                    <form action="{{ route('bids.store', $auction->id) }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $auction->current_price + 1000 }}">
                        <button type="submit"
                            class="w-full bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition">
                            💰 Tawar Sekarang (+Rp1.000)
                        </button>
                    </form>
                    @endif
            </div>
            @empty
            <div class="col-span-full text-center text-gray-500 py-10">
                Belum ada lelang aktif.
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $auctions->links() }}
        </div>
    </div>
    </div>
</x-app-layout>
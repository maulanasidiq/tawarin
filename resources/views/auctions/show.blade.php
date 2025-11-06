<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Lelang') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- 🖼️ Gambar Produk -->
                <div>
                    @if($auction->images && $auction->images->count() > 0)
                    <div class="relative">
                        <!-- Gambar utama -->
                        <img id="mainImage"
                            src="{{ asset('storage/' . $auction->images->first()->image_path) }}"
                            class="w-full h-80 object-cover rounded-lg shadow transition-all duration-300">
                    </div>

                    <!-- Thumbnail -->
                    <div class="grid grid-cols-4 gap-2 mt-3">
                        @foreach($auction->images as $img)
                        <img src="{{ asset('storage/' . $img->image_path) }}"
                            class="h-20 w-full object-cover rounded-md cursor-pointer border border-transparent hover:border-blue-500 transition"
                            onclick="document.getElementById('mainImage').src=this.src">
                        @endforeach
                    </div>
                    @elseif($auction->image)
                    <img src="{{ asset('storage/' . $auction->image) }}"
                        class="w-full h-80 object-cover rounded-lg shadow">
                    @else
                    <div class="w-full h-80 flex items-center justify-center bg-gray-200 rounded-lg text-gray-500">
                        Tidak ada gambar
                    </div>
                    @endif
                </div>

                <!-- 📦 Detail Produk -->
                <div>
                    <h1 class="text-2xl font-bold mb-2 flex items-center gap-2">
                        {{ $auction->title }}
                        @if($auction->user_id === auth()->id())
                        <span class="flex items-center gap-1 text-xs bg-blue-600 text-white px-2 py-1 rounded-md">
                            🏷️ Barang Milik Saya
                        </span>
                        @endif
                    </h1>

                    <p class="text-gray-600 mb-4">{{ $auction->description }}</p>

                    <div class="space-y-2">
                        <div>
                            <p class="text-sm text-gray-500">Harga Awal</p>
                            <p class="text-lg font-semibold">Rp{{ number_format($auction->starting_price) }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Harga Saat Ini</p>
                            <p class="text-2xl font-bold text-green-600">
                                Rp{{ number_format($auction->current_price ?? $auction->starting_price) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Berakhir pada</p>
                            <p class="text-md font-medium text-red-600">
                                {{ \Carbon\Carbon::parse($auction->end_time)->format('d M Y H:i') }}
                            </p>
                        </div>
                    </div>

                    <!-- 🧾 Form Penawaran -->
                    @auth
                    @if($auction->user_id === auth()->id())
                    <div class="mt-4 p-4 border border-blue-300 bg-blue-50 rounded-lg text-blue-700">
                        <strong>Barang Milik Saya</strong><br>
                        Kamu tidak bisa menawar barang yang kamu lelang sendiri.
                    </div>
                    @else
                    <form action="{{ route('bids.store', $auction) }}" method="POST" class="mt-4">
                        @csrf
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">
                            Masukkan Penawaran
                        </label>
                        <input type="number" id="amount" name="amount"
                            min="{{ $auction->current_price + 1000 }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm mb-3"
                            placeholder="Rp..." required>

                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            💸 Bid Sekarang
                        </button>
                    </form>
                    @endif
                    @else
                    <p class="text-gray-500 mt-4">
                        Silakan <a href="{{ route('login') }}" class="text-blue-600 underline">login</a> untuk ikut lelang.
                    </p>
                    @endauth
                </div>
            </div>

            <!-- 📜 Riwayat Penawaran -->
            <div class="mt-10 bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-lg font-bold mb-4">Riwayat Penawaran</h2>
                @if($auction->bids->count() > 0)
                <ul class="divide-y divide-gray-200">
                    @foreach($auction->bids()->latest()->take(10)->get() as $bid)
                    <li class="py-2 flex justify-between text-sm sm:text-base">
                        <span class="font-medium text-gray-700">{{ $bid->user->name }}</span>
                        <span class="font-semibold text-blue-600">Rp{{ number_format($bid->amount) }}</span>
                        <span class="text-gray-500 text-xs">{{ $bid->created_at->diffForHumans() }}</span>
                    </li>
                    @endforeach
                </ul>
                @else
                <p class="text-gray-500">Belum ada penawaran.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
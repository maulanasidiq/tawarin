<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🏆 Detail Lelang Dimenangkan
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto bg-white shadow rounded-xl p-6">
            <h1 class="text-2xl font-bold text-green-600 mb-4">
                🎉 Selamat! Kamu memenangkan lelang ini
            </h1>

            @if($auction->image)
            <img src="{{ asset('storage/' . $auction->image) }}"
                alt="Gambar {{ $auction->title }}"
                class="rounded-lg mb-4 w-full h-64 object-cover">
            @endif

            <h2 class="text-xl font-semibold mb-2">{{ $auction->title }}</h2>
            <p class="text-gray-600 mb-4">{{ $auction->description }}</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p><strong>Harga Awal:</strong> Rp {{ number_format($auction->starting_price, 0, ',', '.') }}</p>
                    <p><strong>Harga Menang:</strong>
                        Rp {{ number_format($auction->bids()->where('is_winner', true)->value('amount'), 0, ',', '.') }}
                    </p>
                </div>
                <div>
                    <p><strong>Berakhir pada:</strong> {{ $auction->end_time->format('d M Y H:i') }}</p>
                    <p><strong>Status:</strong>
                        <span class="text-{{ $auction->status === 'closed' ? 'red' : 'green' }}-600 font-medium">
                            {{ ucfirst($auction->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-2">📋 Riwayat Tawaran</h3>
                <table class="w-full text-sm text-left border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-3">Nama Penawar</th>
                            <th class="py-2 px-3">Tawaran</th>
                            <th class="py-2 px-3">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($auction->bids as $bid)
                        <tr class="border-b {{ $bid->is_winner ? 'bg-green-50 font-bold' : '' }}">
                            <td class="py-2 px-3">{{ $bid->user->name }}</td>
                            <td class="py-2 px-3">Rp {{ number_format($bid->amount, 0, ',', '.') }}</td>
                            <td class="py-2 px-3">{{ $bid->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 text-right">
                <a href="{{ route('user.auctions.won') }}"
                    class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                    ⬅️ Kembali ke Daftar Menang
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
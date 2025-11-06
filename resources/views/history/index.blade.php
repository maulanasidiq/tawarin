<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📊 Riwayat Lelang
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Semua Tawaran -->
            <div class="bg-white shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-4">Tawaran Saya</h3>
                <ul class="divide-y divide-gray-200">
                    @forelse($bids as $bid)
                    <li class="py-3 flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-800">
                                {{ $bid->auction->title }}
                            </p>
                            <p class="text-sm text-gray-500">
                                Tawaran: Rp {{ number_format($bid->amount, 0, ',', '.') }}
                                • {{ $bid->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <a href="{{ route('auctions.show', $bid->auction->id) }}"
                            class="text-blue-600 hover:underline text-sm">Detail</a>
                    </li>
                    @empty
                    <li class="py-4 text-center text-gray-500">Belum ada tawaran.</li>
                    @endforelse
                </ul>
                <div class="mt-4">{{ $bids->links() }}</div>
            </div>

            <!-- Lelang Dimenangkan -->
            <div class="bg-white shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-4">Lelang yang Dimenangkan</h3>
                <ul class="divide-y divide-gray-200">
                    @forelse($wonBids as $bid)
                    <li class="py-3 flex justify-between items-center bg-green-50 px-3 rounded-lg mb-2">
                        <div>
                            <p class="font-medium text-gray-800">
                                {{ $bid->auction->title }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Menang dengan tawaran Rp {{ number_format($bid->amount, 0, ',', '.') }}
                            </p>
                        </div>
                        <a href="{{ route('auctions.show', $bid->auction->id) }}"
                            class="text-green-700 hover:underline text-sm">Lihat</a>
                    </li>
                    @empty
                    <li class="py-4 text-center text-gray-500">Belum memenangkan lelang.</li>
                    @endforelse
                </ul>
                <div class="mt-4">{{ $wonBids->links() }}</div>
            </div>

        </div>
    </div>
</x-app-layout>
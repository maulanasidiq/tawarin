<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📦 Barang Saya yang Ditawar
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">
                @forelse($myAuctions as $auction)
                <div class="border-b pb-4 mb-4">
                    <h3 class="font-bold text-lg">{{ $auction->title }}</h3>
                    <p class="text-gray-500 text-sm">Total Tawaran: {{ $auction->bids->count() }}</p>
                    <ul class="mt-2 text-sm text-gray-700">
                        @foreach($auction->bids as $bid)
                        <li>
                            💰 Rp {{ number_format($bid->amount, 0, ',', '.') }} —
                            oleh <strong>{{ $bid->user->name }}</strong>
                            <span class="text-gray-500">({{ $bid->created_at->diffForHumans() }})</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @empty
                <p class="text-center text-gray-500">Belum ada barang kamu yang ditawar.</p>
                @endforelse

                <div class="mt-4">
                    {{ $myAuctions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
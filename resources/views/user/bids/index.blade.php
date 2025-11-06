<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📊 Riwayat Tawaran
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-3">Barang</th>
                            <th class="py-2 px-3">Nominal Tawaran</th>
                            <th class="py-2 px-3">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bids as $bid)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-3">
                                <a href="{{ route('auctions.show', $bid->auction->id) }}"
                                    class="text-blue-600 hover:underline font-medium">
                                    {{ $bid->auction->title }}
                                </a>
                            </td>
                            <td class="py-2 px-3">
                                Rp {{ number_format($bid->amount, 0, ',', '.') }}
                            </td>
                            <td class="py-2 px-3">
                                {{ $bid->created_at->format('d M Y H:i') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center text-gray-500">
                                Belum ada tawaran.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $bids->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
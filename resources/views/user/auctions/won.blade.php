<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🏆 Lelang Dimenangkan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-3">Barang</th>
                            <th class="py-2 px-3">Harga Menang</th>
                            <th class="py-2 px-3">Tanggal Menang</th>
                            <th class="py-2 px-3 text-center">Aksi</th> <!-- ✅ Tambahan kolom -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wonBids as $bid)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-3">
                                {{ $bid->auction->title }}
                            </td>
                            <td class="py-2 px-3">
                                Rp {{ number_format($bid->amount, 0, ',', '.') }}
                            </td>
                            <td class="py-2 px-3">
                                {{ $bid->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="py-2 px-3 text-center">
                                <!-- ✅ Tombol Lihat Detail -->
                                <a href="{{ route('user.auctions.showWon', $bid->auction->id) }}"
                                    class="inline-block px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">
                                Belum ada lelang yang dimenangkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $wonBids->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
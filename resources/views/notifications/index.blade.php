<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🔔 Notifikasi
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">

                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">Kotak Notifikasi</h3>
                    <form action="{{ route('notifications.readAll') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Tandai Semua Terbaca
                        </button>
                    </form>
                </div>

                <!-- List -->
                <ul class="divide-y divide-gray-200">
                    @forelse($notifications as $notif)
                    <li class="py-4 px-3 flex justify-between items-start 
                                   {{ $notif->read_at ? 'bg-gray-50' : 'bg-yellow-50' }} 
                                   rounded-lg mb-2">

                        <div>
                            <!-- Judul -->
                            <p class="font-semibold text-gray-800 flex items-center gap-2">
                                {{ $notif->data['title'] ?? 'Notifikasi' }}
                                @if(is_null($notif->read_at))
                                <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">
                                    Baru
                                </span>
                                @endif
                            </p>

                            <!-- Pesan -->
                            <p class="text-gray-700 mt-1">
                                {{ $notif->data['message'] ?? '-' }}
                            </p>

                            <!-- Timestamp -->
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $notif->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <!-- Link Detail -->
                        @if(isset($notif->data['url']))
                        <a href="{{ $notif->data['url'] }}"
                            class="text-blue-600 hover:underline text-sm ml-4">
                            Lihat Detail
                        </a>
                        @elseif(isset($notif->data['auction_id']))
                        <a href="{{ route('user.auctions.showWon', $notif->data['auction_id']) }}"
                            class="text-blue-600 hover:underline text-sm ml-4">
                            Lihat Detail
                        </a>
                        @endif

                    </li>
                    @empty
                    <li class="py-6 text-center text-gray-500">
                        Belum ada notifikasi.
                    </li>
                    @endforelse
                </ul>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Barang Lelang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('auctions.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Judul -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Barang</label>
                        <input id="title" type="text" name="title" value="{{ old('title') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="description" name="description" rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('description') }}</textarea>
                        @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Harga Awal -->
                    <div class="mb-4">
                        <label for="starting_price" class="block text-sm font-medium text-gray-700">Harga Awal</label>
                        <input id="starting_price" type="number" name="starting_price" value="{{ old('starting_price') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('starting_price')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Waktu Mulai -->
                    <div class="mb-4">
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                        <input id="start_time" type="datetime-local" name="start_time" value="{{ old('start_time') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('start_time')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Waktu Selesai -->
                    <div class="mb-4">
                        <label for="end_time" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                        <input id="end_time" type="datetime-local" name="end_time" value="{{ old('end_time') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('end_time')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Upload Gambar (Multiple) -->
                    <div class="mb-6">
                        <label for="images" class="block text-sm font-medium text-gray-700">Upload Gambar Barang</label>
                        <input id="images" type="file" name="images[]" multiple
                            class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 cursor-pointer">
                        <p class="text-sm text-gray-500 mt-1">Kamu bisa pilih lebih dari satu gambar (JPG, PNG, max 2MB per file).</p>

                        @error('images.*')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        <!-- Preview Gambar -->
                        <div id="preview" class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-3"></div>
                    </div>

                    <script>
                        document.getElementById('images').addEventListener('change', function(e) {
                            const preview = document.getElementById('preview');
                            preview.innerHTML = ''; // hapus preview lama

                            for (const file of e.target.files) {
                                const reader = new FileReader();
                                reader.onload = function(event) {
                                    const img = document.createElement('img');
                                    img.src = event.target.result;
                                    img.className = 'w-full h-32 object-cover rounded-lg shadow';
                                    preview.appendChild(img);
                                };
                                reader.readAsDataURL(file);
                            }
                        });
                    </script>


                    <!-- Tombol -->
                    <div class="flex justify-end">
                        <a href="{{ route('auctions.index') }}" class="bg-gray-300 px-4 py-2 rounded mr-2">Batal</a>
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
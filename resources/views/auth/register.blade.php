<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-4xl font-extrabold text-blue-600">Tawarin</h1>
        <p class="text-gray-500 mt-2">Buat akun dan mulai ikut lelang seru 🎉</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name"
                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring focus:ring-blue-200"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email"
                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring focus:ring-blue-200"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password"
                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring focus:ring-blue-200"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-600 focus:ring focus:ring-blue-200"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Tombol Register -->
        <x-primary-button
            class="w-full justify-center bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 rounded-lg transition">
            {{ __('Daftar') }}
        </x-primary-button>
    </form>

    <p class="text-sm text-gray-600 mt-6 text-center">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Login</a>
    </p>
</x-guest-layout>
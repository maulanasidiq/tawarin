<x-guest-layout>
    <div>
        <div class="text-center mb-6">
            <h1 class="text-4xl font-extrabold text-blue-700">Tawarin</h1>
            <p class="text-gray-500 mt-2">Masuk dan mulai menawar barang favoritmu 💸</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email"
                    class="block mt-1 w-full rounded-lg focus:border-blue-600 focus:ring focus:ring-blue-200"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password"
                    class="block mt-1 w-full rounded-lg focus:border-blue-600 focus:ring focus:ring-blue-200"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me + Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                </label>

                @if (Route::has('password.request'))
                <a class="text-sm text-blue-700 hover:underline" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
                @endif
            </div>

            <!-- Tombol Login -->
            <x-primary-button
                class="w-full justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg transition">
                {{ __('Login') }}
            </x-primary-button>
        </form>

        <p class="text-sm text-gray-600 mt-6 text-center">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-700 font-semibold hover:underline">Daftar Sekarang</a>
        </p>
    </div>
</x-guest-layout>
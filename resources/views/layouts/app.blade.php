<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tawarin') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50">

    {{-- 🔹 Navbar Modern --}}
    <nav class="bg-white shadow-sm fixed w-full z-50 top-0 left-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('logo/logo-tawarin.png') }}" alt="Tawarin" class="h-9 w-9 rounded-full">
                    <span
                        class="font-bold text-xl bg-gradient-to-r from-blue-600 to-purple-600 text-transparent bg-clip-text">
                        Tawarin
                    </span>
                </div>

                <!-- Menu Utama -->
                <div class="hidden md:flex space-x-8 font-medium">
                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('auctions.index') }}"
                        class="{{ request()->routeIs('auctions.*') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                        Lelang
                    </a>
                    <a href="{{ route('user.bids.index') }}"
                        class="{{ request()->routeIs('user.bids.*') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                        Tawaran
                    </a>
                    <a href="{{ route('user.auctions.won') }}"
                        class="{{ request()->routeIs('user.auctions.won') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                        Menang
                    </a>
                </div>

                <!-- User Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                        <img src="{{ asset('profile.png') }}" class="w-8 h-8 rounded-full border">
                        <span class="font-medium text-gray-700">{{ Auth::user()->name }}</span>
                    </button>

                    <div
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">👤 Profil</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">🚪 Logout</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <!-- Spacer biar konten gak ketimpa navbar -->
    <div class="h-16"></div>

    <div class="min-h-screen bg-gray-100">
        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Toast Notifications -->
        @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-5 right-5 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-5 right-5 bg-red-600 text-white px-4 py-3 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
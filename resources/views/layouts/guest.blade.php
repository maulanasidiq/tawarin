<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tawarin') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">
    <div class="min-h-screen grid grid-cols-1 md:grid-cols-2">
        <!-- Bagian Kiri -->
        <div class="hidden md:flex flex-col justify-center items-center bg-gradient-to-br from-blue-500 to-purple-600 text-white p-10">
            <div class="max-w-md text-center space-y-6">
                <h1 class="text-5xl font-extrabold">
                    Selamat Datang di <span class="text-yellow-300">Tawarin</span>
                </h1>
                <p class="text-lg opacity-90">
                    Tempat kamu bisa menawar dan mendapatkan barang terbaik dengan harga bersaing 💸
                </p>
                <img src="{{ asset('logo/logo-tawarin.png') }}"
                    alt="Logo Tawarin"
                    class="w-64 mx-auto drop-shadow-xl"> 
            </div>
        </div>

        <!-- Bagian Kanan -->
        <div class="flex items-center justify-center bg-gray-50">
            <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 mx-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }} | Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans antialiased">
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white shadow-lg hidden md:flex flex-col">
            <div class="p-6 text-2xl font-bold tracking-wide">
                Admin Panel
            </div>
            <nav class="mt-6 flex-1 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-lg transition 
                        hover:bg-blue-700 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-900 font-semibold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3v18h18M9 17V9m4 8V5m4 12v-6" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- Kelola Lelang -->
                <a href="{{ route('admin.auctions.index') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-lg transition 
                        hover:bg-blue-700 {{ request()->routeIs('admin.auctions.*') ? 'bg-blue-900 font-semibold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9M10 21h4" />
                    </svg>
                    <span>Kelola Lelang</span>
                </a>

                <!-- Kelola User -->
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-lg transition 
                        hover:bg-blue-700 {{ request()->routeIs('admin.users.*') ? 'bg-blue-900 font-semibold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A9 9 0 0112 15a9 9 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Kelola User</span>
                </a>

                <!-- Kelola Tawaran (Bids) -->
                <a href="{{ route('admin.bids.index') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-lg transition 
                        hover:bg-blue-700 {{ request()->routeIs('admin.bids.*') ? 'bg-blue-900 font-semibold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.1 0-2 .9-2 2v8h4v-8c0-1.1-.9-2-2-2zM5 20h14" />
                    </svg>
                    <span>Kelola Tawaran</span>
                </a>

                <!-- Laporan -->
                <a href="{{ route('admin.reports.index') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-lg transition 
                        hover:bg-blue-700 {{ request()->routeIs('admin.reports.*') ? 'bg-blue-900 font-semibold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-6h13M9 5v6h13M3 5h6v14H3z" />
                    </svg>
                    <span>Laporan</span>
                </a>
            </nav>

            <div class="p-6 text-sm text-gray-200 border-t border-blue-700">
                © {{ date('Y') }} {{ config('app.name') }}
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Topbar -->
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-700">@yield('title', 'Admin')</h1>
                <div class="flex items-center gap-3">
                    <!-- Avatar bulat -->
                    <div class="w-8 h-8 bg-blue-600 text-white flex items-center justify-center rounded-full">
                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                    </div>
                    <span class="text-gray-600 font-medium">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 flex-1 bg-gray-50">
                <div class="bg-white shadow rounded-xl p-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>

</html>
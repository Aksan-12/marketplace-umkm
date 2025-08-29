<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>
        
        <link rel="icon" href="{{ asset('images/tbm.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="font-sans antialiased flex flex-col min-h-screen">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex-grow">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Footer -->
        <footer class="bg-green-800 text-white">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Kolom 1: Logo dan Alamat -->
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <img class="h-12 w-12 mr-3" src="{{ asset('images/tbm.png') }}" alt="CV. Tunas Baru Moilong Logo">
                            <span class="font-bold text-lg">CV. Tunas Baru Moilong</span>
                        </div>
                        <p class="text-sm text-green-200">
                            Desa Mulyoharjo, Kec. Moilong,<br>
                            Kab. Banggai, Sulawesi Tengah
                        </p>
                    </div>

                    <!-- Kolom 2: Hubungi Kami -->
                    <div class="space-y-4">
                        <h3 class="font-semibold uppercase tracking-wider">Hubungi Kami</h3>
                        <div class="space-y-2 text-sm">
                            <a href="#" class="flex items-center text-green-200 hover:text-white">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                                <span>Wa & Telp : 08123456789</span>
                            </a>
                            <a href="#" class="flex items-center text-green-200 hover:text-white">
                               <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                                <span>Email : Tunastbm@gmail.com</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Kolom 3: Navigasi -->
                    <div class="space-y-4">
                         <h3 class="font-semibold uppercase tracking-wider">Tautan</h3>
                         <div class="space-y-2 text-sm">
                             <a href="{{ route('home') }}" class="block text-green-200 hover:text-white">Beranda</a>
                             <a href="{{ route('about') }}" class="block text-green-200 hover:text-white">Tentang Kami</a>
                         </div>
                    </div>
                </div>

                <div class="mt-8 border-t border-green-700 pt-6 text-center text-sm text-green-300">
                    &copy; {{ date('Y') }} CV. Tunas Baru Moilong. All Rights Reserved.
                </div>
            </div>
        </footer>
    </body>
</html>

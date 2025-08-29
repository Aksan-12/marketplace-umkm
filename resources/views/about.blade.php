<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tentang Kami - CV. Tunas Baru Moilong</title>
        <!-- Fonts -->
        <link rel="icon" href="{{ asset('images/tbm.png') }}" type="image/png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-50 dark:bg-gray-900 flex flex-col min-h-screen">
        <div class="flex-grow">
            <!-- Header -->
            <header class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50">
                <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <!-- Logo and Company Name -->
                        <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                            <img class="h-12 w-12 mr-3" src="{{ asset('images/tbm.png') }}" alt="CV. Tunas Baru Moilong Logo">
                            <h1 class="hidden sm:block text-xl font-bold text-gray-800 dark:text-white">CV. Tunas Baru Moilong</h1>
                        </a>
                        <!-- Login/Register/Dashboard Links -->
                        <div class="flex items-center">
                            @if (Route::has('login'))
                                <div class="text-right">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Log in</a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </nav>
            </header>

            <main>
                <!-- Page Header -->
                <div class="bg-gray-100 dark:bg-gray-700">
                    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Tentang CV. Tunas Baru Moilong</h1>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="py-12 bg-white dark:bg-gray-800">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="lg:text-center">
                            <h2 class="text-base text-green-600 font-semibold tracking-wide uppercase">Visi & Misi Kami</h2>
                            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                                Menyediakan Bibit Unggul untuk Masa Depan Perkebunan
                            </p>
                            <p class="mt-4 max-w-2xl text-xl text-gray-500 dark:text-gray-400 lg:mx-auto">
                                Kami berkomitmen untuk mendukung para petani dan pengusaha perkebunan dengan menyediakan produk bibit kelapa sawit berkualitas tinggi yang telah teruji.
                            </p>
                        </div>

                        <div class="mt-10">
                            <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                                <div class="relative">
                                    <dt>
                                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9V3m0 18a9 9 0 009-9m-9 9a9 9 0 00-9-9" />
                                            </svg>
                                        </div>
                                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900 dark:text-white">Kualitas Terjamin</p>
                                    </dt>
                                    <dd class="mt-2 ml-16 text-base text-gray-500 dark:text-gray-400">
                                        Setiap produk yang kami jual telah melalui proses seleksi dan kontrol kualitas yang ketat untuk memastikan pertumbuhan yang optimal dan hasil panen yang maksimal.
                                    </dd>
                                </div>

                                <div class="relative">
                                    <dt>
                                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2" />
                                            </svg>
                                        </div>
                                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900 dark:text-white">Dukungan Petani Lokal</p>
                                    </dt>
                                    <dd class="mt-2 ml-16 text-base text-gray-500 dark:text-gray-400">
                                        Kami bekerja sama dengan para petani lokal untuk memberdayakan komunitas dan memastikan bahwa setiap bibit dirawat dengan metode terbaik.
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
        <!-- Footer -->
        <footer class="bg-green-800 text-white">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
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

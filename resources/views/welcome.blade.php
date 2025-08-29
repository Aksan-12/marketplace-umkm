<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CV. Tunas Baru Moilong</title>
        <!-- Fonts -->
        <link rel="icon" href="{{ asset('images/tbm.png') }}" type="image/png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- CSS untuk Animasi -->
        <style>
            /* Animasi Fade-in dan Slide-up */
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes slideUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-on-load {
                animation: fadeIn 0.8s ease-out, slideUp 0.8s ease-out;
            }
            .animate-slide-up {
                 animation: slideUp 0.8s ease-out forwards;
                 opacity: 0; /* Mulai transparan */
            }

            /* Animasi Kartu Produk saat Scroll */
            .product-card {
                opacity: 0;
                transform: translateY(20px);
                transition: opacity 0.5s ease-out, transform 0.5s ease-out;
            }
            .product-card.is-visible {
                opacity: 1;
                transform: translateY(0);
            }
            /* Efek Zoom pada Gambar Produk */
            .product-card .overflow-hidden {
                 overflow: hidden;
            }
            .product-card img {
                transition: transform 0.3s ease-in-out;
            }
            .product-card:hover img {
                transform: scale(1.1);
            }
        </style>
    </head>
    <body class="antialiased bg-gray-50 dark:bg-gray-900 flex flex-col min-h-screen">
        <div class="flex-grow">
            <!-- Header -->
            <header class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50">
                <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <!-- Logo and Company Name -->
                        <div class="flex-shrink-0 flex items-center">
                            <img class="h-12 w-12 mr-3" src="{{ asset('images/tbm.png') }}" alt="CV. Tunas Baru Moilong Logo">
                            <h1 class="hidden sm:block text-xl font-bold text-gray-800 dark:text-white">CV. Tunas Baru Moilong</h1>
                        </div>
                        <!-- Login/Register/Dashboard Links -->
                        <div class="flex items-center">
                            @if (Route::has('login'))
                                <div class="text-right">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </nav>
            </header>

            <main>
                <!-- Hero Section with Background Image -->
                <div class="relative bg-cover bg-center text-white" style="background-image: url('{{ asset('images/bibit.jpg') }}');">
                    <div class="absolute inset-0 bg-green-800 bg-opacity-60"></div>
                    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8 text-center">
                        <h2 class="text-4xl font-extrabold tracking-tight text-white drop-shadow-lg animate-on-load">Produk Lokal Berkualitas</h2>
                        <p class="mt-4 text-lg text-gray-200 drop-shadow-md animate-slide-up" style="animation-delay: 0.5s;">Temukan berbagai produk unggulan langsung dari UMKM terbaik di sekitar Anda.</p>
                    </div>
                </div>

                <!-- Product Grid Section -->
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 px-4 sm:px-0">Jelajahi Produk Kami</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @forelse ($products as $product)
                                <div class="product-card bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="overflow-hidden">
                                        <img src="{{ $product->photo ? asset('storage/' . $product->photo) : 'https://via.placeholder.com/400x300.png/EBF4FA/333333?text=Produk' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                    </div>
                                    <div class="p-4">
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white truncate">{{ $product->name }}</h4>
                                        <p class="text-gray-600 dark:text-gray-400 mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <p class="text-sm text-gray-500 mt-2">Stok: {{ $product->stock }}</p>
                                        <div class="mt-4">
                                            @if($product->stock > 0)
                                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="w-full text-center inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300">
                                                        Tambah ke Keranjang
                                                    </button>
                                                </form>
                                            @else
                                                <button class="w-full text-center inline-block px-4 py-2 bg-red-200 text-red-600 font-bold rounded-md cursor-not-allowed">
                                                    Stok Habis
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full text-center py-12">
                                    <p class="text-gray-500 dark:text-gray-400">Saat ini belum ada produk yang tersedia.</p>
                                </div>
                            @endforelse
                        </div>
                        <!-- Pagination Links -->
                        <div class="mt-8">
                            {{ $products->links() }}
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

        <!-- JavaScript untuk Animasi Scroll -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const observerOptions = {
                    root: null,
                    rootMargin: "0px",
                    threshold: 0.1
                };

                const observer = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);

                const productCards = document.querySelectorAll('.product-card');
                productCards.forEach((card, index) => {
                    card.style.transitionDelay = `${index * 100}ms`;
                    observer.observe(card);
                });
            });
        </script>
    </body>
</html>

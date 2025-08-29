@section('title', 'Dashboard')

<x-app-layout>
    {{-- CSS Khusus untuk Halaman Cetak --}}
    <style>
        @media print {
            /* Sembunyikan semua elemen di body secara default */
            body * {
                visibility: hidden;
            }
            /* Tampilkan hanya area yang bisa dicetak dan isinya */
            .printable-area, .printable-area * {
                visibility: visible;
            }
            /* Posisikan area cetak di paling atas halaman */
            .printable-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            /* Sembunyikan tombol cetak itu sendiri */
            .no-print {
                display: none;
            }
        }
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            {{-- Tombol Cetak Laporan --}}
            <button onclick="window.print()" class="no-print inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Cetak Laporan
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold">Selamat Datang Kembali, {{ Auth::user()->name }}!</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">Berikut adalah ringkasan aktivitas Anda di Marketplace CV. Tunas Baru Moilong</p>
                </div>
            </div>

            <!-- Role-Specific Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 no-print">
                @if(Auth::user()->role == 'pembeli')
                    @php
                        $pendingOrders = \App\Models\Order::where('user_id', Auth::id())->where('status', 'pending')->count();
                        $completedOrders = \App\Models\Order::where('user_id', Auth::id())->where('status', 'completed')->count();
                    @endphp
                    <!-- Pembeli View -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-start">
                        <div class="mr-4 text-blue-500">
                           <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Pesanan Pending</h4>
                            <p class="text-3xl font-bold mt-1">{{ $pendingOrders }}</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-start">
                         <div class="mr-4 text-green-500">
                           <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Pesanan Selesai</h4>
                            <p class="text-3xl font-bold mt-1">{{ $completedOrders }}</p>
                        </div>
                    </div>
                @elseif(Auth::user()->role == 'penjual')
                    @php
                        $activeProducts = \App\Models\Product::where('user_id', Auth::id())->count();
                        $sellerProductIds = \App\Models\Product::where('user_id', Auth::id())->pluck('id');
                        $newOrderIds = \App\Models\OrderItem::whereIn('product_id', $sellerProductIds)->pluck('order_id')->unique();
                        $newOrdersCount = \App\Models\Order::whereIn('id', $newOrderIds)->whereIn('status', ['paid', 'processing'])->count();
                    @endphp
                    <!-- Penjual View -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-start">
                        <div class="mr-4 text-indigo-500">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Produk Aktif</h4>
                            <p class="text-3xl font-bold mt-1">{{ $activeProducts }}</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-start">
                        <div class="mr-4 text-yellow-500">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Pesanan Perlu Diproses</h4>
                            <p class="text-3xl font-bold mt-1">{{ $newOrdersCount }}</p>
                        </div>
                    </div>
                @elseif(Auth::user()->role == 'admin')
                     <!-- Admin View -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-start">
                        <div class="mr-4 text-purple-500">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Total Pengguna</h4>
                            <p class="text-3xl font-bold mt-1">{{ \App\Models\User::count() }}</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-start">
                        <div class="mr-4 text-red-500">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Pesanan Masuk</h4>
                            <p class="text-3xl font-bold mt-1">{{ \App\Models\Order::where('status', 'pending')->count() }}</p>
                        </div>
                    </div>
                     <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-start">
                        <div class="mr-4 text-teal-500">
                           <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Total Produk</h4>
                            <p class="text-3xl font-bold mt-1">{{ \App\Models\Product::count() }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Area Cetak / Aktivitas Terbaru -->
            <div class="printable-area">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Aktivitas Terbaru</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Invoice</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Total</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @php
                                        // Ambil data order berdasarkan role
                                        if (Auth::user()->role == 'admin') {
                                            $recentOrders = \App\Models\Order::latest()->take(10)->get();
                                        } elseif (Auth::user()->role == 'penjual') {
                                            $sellerProductIds = Auth::user()->products()->pluck('id');
                                            $recentOrders = \App\Models\Order::whereHas('items', function ($query) use ($sellerProductIds) {
                                                $query->whereIn('product_id', $sellerProductIds);
                                            })->latest()->take(10)->get();
                                        } else { // pembeli
                                            $recentOrders = \App\Models\Order::where('user_id', Auth::id())->latest()->take(10)->get();
                                        }
                                    @endphp
                                    @forelse ($recentOrders as $order)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $order->invoice_number }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $order->created_at->format('d M Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($order->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                                    @if($order->status == 'paid' || $order->status == 'processing') bg-blue-100 text-blue-800 @endif
                                                    @if($order->status == 'shipped' || $order->status == 'completed') bg-green-100 text-green-800 @endif
                                                    @if($order->status == 'cancelled') bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                                Tidak ada aktivitas terbaru.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

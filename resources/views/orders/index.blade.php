@section('title', 'Riwayat Pesanan Saya')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900">
                    
                    <!-- Desktop Table View -->
                    <div class="hidden lg:block">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Invoice</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->invoice_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                                @if($order->status == 'paid') bg-green-100 text-green-800 @endif
                                                @if($order->status == 'shipped') bg-blue-100 text-blue-800 @endif
                                                @if($order->status == 'completed') bg-gray-100 text-gray-800 @endif
                                                @if($order->status == 'cancelled') bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <a href="{{ route('orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Anda belum memiliki riwayat pesanan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="lg:hidden space-y-4">
                        @forelse ($orders as $order)
                            <div class="bg-gray-50 p-4 rounded-lg border">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold">{{ $order->invoice_number }}</p>
                                        <p class="text-sm text-gray-600">{{ $order->created_at->format('d M Y') }}</p>
                                    </div>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                        @if($order->status == 'paid') bg-green-100 text-green-800 @endif
                                        @if($order->status == 'shipped') bg-blue-100 text-blue-800 @endif
                                        @if($order->status == 'completed') bg-gray-100 text-gray-800 @endif
                                        @if($order->status == 'cancelled') bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                <div class="mt-4 flex justify-between items-center">
                                    <p class="text-gray-800 font-medium">Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                    <a href="{{ route('orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Lihat Detail</a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 py-8">
                                <p>Anda belum memiliki riwayat pesanan.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

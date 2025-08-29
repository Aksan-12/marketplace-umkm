@section('title', 'Pesanan Masuk')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesanan Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="space-y-6">
                        @forelse ($orders as $order)
                            <div class="bg-gray-50 p-4 rounded-lg border">
                                <div class="flex flex-col sm:flex-row justify-between sm:items-center border-b pb-3 mb-3">
                                    <div>
                                        <p class="font-bold">{{ $order->invoice_number }}</p>
                                        <p class="text-sm text-gray-600">Tanggal: {{ $order->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm">Status: 
                                            <span class="font-medium px-2 py-1 text-xs rounded-full
                                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                                @if($order->status == 'paid') bg-green-100 text-green-800 @endif
                                                @if($order->status == 'shipped') bg-blue-100 text-blue-800 @endif
                                                @if($order->status == 'completed') bg-gray-200 text-gray-800 @endif
                                                @if($order->status == 'cancelled') bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h4 class="font-semibold">Detail Pelanggan:</h4>
                                    <p class="text-sm">Nama: {{ $order->customer_name }}</p>
                                    <p class="text-sm">No. HP: {{ $order->phone_number }}</p>
                                </div>

                                <div>
                                    <h4 class="font-semibold">Produk yang Dipesan:</h4>
                                    <ul class="list-disc list-inside text-sm mt-1">
                                        @foreach($order->items as $item)
                                            <li>{{ $item->product->name }} ({{ $item->quantity }} pcs)</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 py-8">
                                <p>Belum ada pesanan yang masuk untuk produk Anda.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

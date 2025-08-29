@section('title', 'Produk Saya')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Ringkasan Pesanan</h3>
                    <table class="min-w-full divide-y divide-gray-200 mb-6">
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($cartItems as $item)
                            @php $subtotal = $item->price * $item->quantity; $total += $subtotal; @endphp
                            <tr>
                                <td class="py-2">{{ $item->name }} (x{{ $item->quantity }})</td>
                                <td class="py-2 text-right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                            <tr class="font-bold">
                                <td class="py-2 border-t">Total</td>
                                <td class="py-2 border-t text-right">Rp {{ number_format($total, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <h3 class="text-lg font-medium mb-4">Detail Pengiriman</h3>
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <!-- Customer Name -->
                        <div>
                            <x-input-label for="customer_name" :value="__('Nama Penerima')" />
                            <x-text-input id="customer_name" class="block mt-1 w-full" type="text" name="customer_name" :value="old('customer_name', Auth::user()->name)" required autofocus />
                            <x-input-error :messages="$errors->get('customer_name')" class="mt-2" />
                        </div>

                        <!-- Phone Number -->
                        <div class="mt-4">
                            <x-input-label for="phone_number" :value="__('Nomor Telepon')" />
                            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>

                        <!-- Shipping Address -->
                        <div class="mt-4">
                            <x-input-label for="shipping_address" :value="__('Alamat Pengiriman')" />
                            <textarea id="shipping_address" name="shipping_address" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('shipping_address') }}</textarea>
                            <x-input-error :messages="$errors->get('shipping_address')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Proses Pesanan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

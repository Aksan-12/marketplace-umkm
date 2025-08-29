<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <h3 class="text-2xl font-bold text-green-600 mb-2">Pesanan Berhasil Dibuat!</h3>
                    <p class="mb-4">Terima kasih telah berbelanja. Segera selesaikan pembayaran Anda.</p>

                    <div class="text-left bg-gray-50 p-4 rounded-lg mb-6">
                        <p class="mb-2"><strong>Nomor Invoice:</strong> {{ $order->invoice_number }}</p>
                        <p><strong>Total Pembayaran:</strong> <span class="font-bold text-red-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span></p>
                    </div>

                    <h4 class="text-lg font-semibold mb-2">Instruksi Pembayaran</h4>
                    <p class="mb-4">Silakan lakukan transfer ke salah satu rekening berikut:</p>

                    <div class="text-left inline-block">
                        <p><strong>Bank BCA:</strong> 123-456-7890 (a.n. Marketplace UMKM)</p>
                        <p><strong>Bank Mandiri:</strong> 098-765-4321 (a.n. Marketplace UMKM)</p>
                    </div>

                    <p class="mt-4 text-sm text-gray-600">Setelah melakukan pembayaran, status pesanan Anda akan kami proses dalam 1x24 jam.</p>

                    <div class="mt-6">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
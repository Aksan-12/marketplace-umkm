@section('title', 'Keranjang Belanja Anda')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang Belanja Anda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif
                     @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(Cart::isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Keranjang belanja Anda kosong</h3>
                            <p class="mt-1 text-sm text-gray-500">Ayo temukan produk terbaik untukmu!</p>
                            <div class="mt-6">
                                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Mulai Belanja
                                </a>
                            </div>
                        </div>
                    @else
                        <!-- Desktop Table View -->
                        <div class="hidden lg:block">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left"><input type="checkbox" id="select-all-desktop" class="select-all-checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"></th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($cartItems as $item)
                                        <tr class="cart-item-row">
                                            <td class="px-4 py-4"><input type="checkbox" value="{{ $item->id }}" class="cart-item-checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" data-price="{{ $item->price }}"></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-16 w-16">
                                                        <img class="h-16 w-16 rounded-md object-cover" src="{{ $item->attributes->photo ? asset('storage/' . $item->attributes->photo) : 'https://via.placeholder.com/150' }}" alt="{{ $item->name }}">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                                    @csrf @method('PATCH')
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" class="item-quantity w-20 border-gray-300 rounded-md shadow-sm" min="1">
                                                    <button type="submit" class="ml-2 text-xs text-indigo-600 hover:text-indigo-900">Update</button>
                                                </form>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap item-subtotal">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="lg:hidden">
                            <div class="flex items-center mb-4 border-b pb-2">
                                <input type="checkbox" id="select-all-mobile" class="select-all-checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <label for="select-all-mobile" class="ml-2 text-sm font-medium text-gray-700">Pilih Semua</label>
                            </div>
                            <div class="space-y-4">
                            @foreach ($cartItems as $item)
                                <div class="cart-item-row bg-gray-50 rounded-lg p-4 border">
                                    <div class="flex">
                                        <input type="checkbox" value="{{ $item->id }}" class="cart-item-checkbox mt-1 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" data-price="{{ $item->price }}">
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-start">
                                                <img class="h-16 w-16 rounded-md object-cover" src="{{ $item->attributes->photo ? asset('storage/' . $item->attributes->photo) : 'https://via.placeholder.com/150' }}" alt="{{ $item->name }}">
                                                <div class="ml-4">
                                                    <p class="font-semibold">{{ $item->name }}</p>
                                                    <p class="text-sm text-gray-600">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-2 flex items-center justify-between">
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                                    @csrf @method('PATCH')
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" class="item-quantity w-20 border-gray-300 rounded-md shadow-sm" min="1">
                                                    <button type="submit" class="ml-2 text-xs text-indigo-600 hover:text-indigo-900">Update</button>
                                                </form>
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Hapus</button>
                                                </form>
                                            </div>
                                             <p class="text-right font-medium mt-2 item-subtotal">Subtotal: Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>

                        <!-- Summary and Actions -->
                        <div class="mt-6 flex flex-col-reverse lg:flex-row justify-between items-center">
                            <div class="w-full lg:w-auto mt-4 lg:mt-0">
                                <a href="{{ route('home') }}" class="w-full text-center inline-block px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Tambah Barang Lagi
                                </a>
                            </div>
                            <div class="text-right w-full lg:w-auto">
                                <form id="checkout-form" action="{{ route('checkout.index') }}" method="GET">
                                    <h3 class="text-xl font-semibold">Total Dipilih: <span id="dynamic-total">Rp 0</span></h3>
                                    <button type="submit" id="checkout-button" class="w-full mt-4 inline-flex justify-center items-center px-6 py-3 bg-green-600 text-white rounded-md hover:bg-green-700 disabled:bg-gray-400" disabled>
                                        Lanjut ke Checkout (<span id="selected-count">0</span>)
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(!Cart::isEmpty())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkoutForm = document.getElementById('checkout-form');
            const selectAllCheckboxes = document.querySelectorAll('.select-all-checkbox');
            const itemRows = document.querySelectorAll('.cart-item-row');
            const dynamicTotalEl = document.getElementById('dynamic-total');
            const checkoutButton = document.getElementById('checkout-button');
            const selectedCountEl = document.getElementById('selected-count');

            function updateTotals() {
                let total = 0;
                let selectedCount = 0;
                
                itemRows.forEach(row => {
                    const checkbox = row.querySelector('.cart-item-checkbox');
                    if (checkbox.checked) {
                        const price = parseFloat(checkbox.dataset.price);
                        const quantity = parseInt(row.querySelector('.item-quantity').value);
                        total += price * quantity;
                        selectedCount++;
                    }
                });

                dynamicTotalEl.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
                selectedCountEl.textContent = selectedCount;
                checkoutButton.disabled = selectedCount === 0;
            }

            selectAllCheckboxes.forEach(sa => {
                sa.addEventListener('change', function () {
                    const isChecked = this.checked;
                    itemRows.forEach(row => {
                        row.querySelector('.cart-item-checkbox').checked = isChecked;
                    });
                    selectAllCheckboxes.forEach(other_sa => {
                        if(other_sa !== this) other_sa.checked = isChecked;
                    });
                    updateTotals();
                });
            });

            itemRows.forEach(row => {
                const checkbox = row.querySelector('.cart-item-checkbox');
                const quantityInput = row.querySelector('.item-quantity');

                function checkSelectAllState() {
                    let allChecked = true;
                    itemRows.forEach(r => {
                        if (!r.querySelector('.cart-item-checkbox').checked) allChecked = false;
                    });
                    selectAllCheckboxes.forEach(sa => sa.checked = allChecked);
                }

                checkbox.addEventListener('change', () => {
                    checkSelectAllState();
                    updateTotals();
                });
                quantityInput.addEventListener('input', updateTotals);
            });
            
            checkoutForm.addEventListener('submit', function(event) {
                // Hapus input tersembunyi yang lama sebelum menambahkan yang baru
                this.querySelectorAll('input[name="selected_items[]"]').forEach(input => input.remove());

                // Ambil semua checkbox yang dicentang dan tambahkan sebagai input tersembunyi
                document.querySelectorAll('.cart-item-checkbox:checked').forEach(checkbox => {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'selected_items[]';
                    hiddenInput.value = checkbox.value;
                    this.appendChild(hiddenInput);
                });
            });

            updateTotals();
        });
    </script>
    @endif
</x-app-layout>

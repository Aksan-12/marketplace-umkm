<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Dapatkan ID produk milik penjual yang sedang login
        $sellerProductIds = $user->products()->pluck('id');

        // 2. Cari semua pesanan (orders) yang mengandung produk-produk tersebut
        $orders = Order::whereHas('items', function ($query) use ($sellerProductIds) {
            $query->whereIn('product_id', $sellerProductIds);
        })
            ->with(['items' => function ($query) use ($sellerProductIds) {
                // Muat hanya item yang relevan untuk penjual ini
                $query->whereIn('product_id', $sellerProductIds)->with('product');
            }])
            ->latest()
            ->paginate(10);

        return view('seller.orders.index', compact('orders'));
    }
}

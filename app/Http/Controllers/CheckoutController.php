<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product; // <-- Pastikan model Product di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getContent();
        if (Cart::isEmpty()) {
            return redirect()->route('home')->with('error', 'Keranjang Anda kosong.');
        }
        return view('checkout.index', compact('cartItems'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'shipping_address' => 'required|string',
        ]);

        // 1. Simpan data order ke database
        $order = Order::create([
            'user_id' => Auth::id(),
            'invoice_number' => 'INV-' . time() . Str::random(5),
            'total_amount' => Cart::getTotal(),
            'customer_name' => $request->customer_name,
            'shipping_address' => $request->shipping_address,
            'phone_number' => $request->phone_number,
            'status' => 'pending', // Status awal
        ]);

        foreach (Cart::getContent() as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);

            // --- BAGIAN YANG DILENGKAPI ---
            // Kurangi stok produk setelah pesanan dibuat
            $product = Product::find($item->id);
            if ($product) {
                $product->decrement('stock', $item->quantity);
            }
            // --- AKHIR BAGIAN YANG DILENGKAPI ---
        }

        // Kosongkan seluruh keranjang setelah checkout
        Cart::clear();

        // Arahkan ke halaman konfirmasi pesanan
        return redirect()->route('orders.show', $order);
    }
}

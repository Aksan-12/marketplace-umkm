<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getContent();
        return view('cart.index', compact('cartItems'));
    }

    public function add(Product $product, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // --- BAGIAN YANG DILENGKAPI ---
        // Cek stok sebelum menambahkan ke keranjang
        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }
        // --- AKHIR BAGIAN YANG DILENGKAPI ---

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => [
                'photo' => $product->photo
            ]
        ]);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // --- BAGIAN YANG DILENGKAPI (Pengecekan Stok Saat Update) ---
        $item = Cart::get($itemId);
        $product = Product::find($item->id);

        if ($product->stock < $request->quantity) {
            return redirect()->route('cart.index')->with('error', 'Stok produk tidak mencukupi untuk jumlah yang diminta.');
        }
        // --- AKHIR BAGIAN YANG DILENGKAPI ---

        Cart::update($itemId, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ],
        ]);

        return redirect()->route('cart.index')->with('success', 'Jumlah produk di keranjang berhasil diperbarui.');
    }

    public function remove($itemId)
    {
        Cart::remove($itemId);
        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}

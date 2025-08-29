<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Ambil hanya produk milik user yang sedang login, urutkan dari yang terbaru
        $products = Product::where('user_id', Auth::id())->latest()->paginate(5);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Tampilkan view untuk form tambah produk
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi input dari form, termasuk stok
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0', // Validasi untuk stok
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = null;
        // 2. Cek apakah ada file foto yang diunggah
        if ($request->hasFile('photo')) {
            // Simpan foto ke folder 'storage/app/public/products'
            $path = $request->file('photo')->store('products', 'public');
        }

        // 3. Buat produk baru di database, termasuk stok
        Product::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock, // Simpan data stok
            'photo' => $path,
        ]);

        // 4. Arahkan kembali ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     * (Kita tidak menggunakan ini, jadi arahkan saja ke index)
     */
    public function show(Product $product): RedirectResponse
    {
        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        // Keamanan: Pastikan penjual hanya bisa mengedit produk miliknya sendiri
        if ($product->user_id !== Auth::id()) {
            abort(403, 'UNAUTHORIZED ACTION.');
        }

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        // Keamanan: Pastikan penjual hanya bisa mengupdate produk miliknya sendiri
        if ($product->user_id !== Auth::id()) {
            abort(403, 'UNAUTHORIZED ACTION.');
        }

        // 1. Validasi input, termasuk stok
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0', // Validasi untuk stok
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $product->photo;
        // 2. Cek jika ada foto baru yang diunggah
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }
            // Simpan foto baru
            $path = $request->file('photo')->store('products', 'public');
        }

        // 3. Update data produk, termasuk stok
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock, // Update data stok
            'photo' => $path,
        ]);

        // 4. Arahkan kembali ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Keamanan: Pastikan penjual hanya bisa menghapus produk miliknya sendiri
        if ($product->user_id !== Auth::id()) {
            abort(403, 'UNAUTHORIZED ACTION.');
        }

        // Hapus foto dari storage jika ada
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        // Hapus data produk dari database
        $product->delete();

        // Arahkan kembali ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product; // <-- Tambahkan ini
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(12); // Ambil 12 produk terbaru
        return view('welcome', compact('products'));
    }

    public function about()
    {
        return view('about');
    }
}

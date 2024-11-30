<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return view('menu', [
            'page' => 'Menu',
            'products' => Product::latest()->filter(request(['search', 'category']))->paginate(8)->withQueryString()
        ]);
    }

    public function show(Product $product) {
        return view('product', [
            'page' => 'Detail Product',
            'product' => $product
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::inRandomOrder()->take(12)->get();
        return view('shop', compact('products'));
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug', '!=', $slug)->inRandomOrder()->take(4)->get(); 
        return view('product', compact('product', 'mightAlsoLike'));
    }
}

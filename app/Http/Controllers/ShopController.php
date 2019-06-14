<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        if ($request->category) {
            $categoryName = $request->category;
            $products = Product::with('categories')->wherehas('categories', function($query) use($categoryName) {
                $query->where('slug', $categoryName);
            })->get(); 
        } else {
            $categoryName = 'feature';
            $products = Product::inRandomOrder()->take(12)->get();
        }

        $categories = Category::all();

        if ($request->sort === 'low_high') {
            $products = $products->sortBy('price');
        } elseif ($request->sort == 'high_low') {
            $products = $products->sortByDesc('price');
        }
        
        return view('shop', compact('products', 'categories', 'categoryName'));
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug', '!=', $slug)->inRandomOrder()->take(4)->get(); 
        return view('product', compact('product', 'mightAlsoLike'));
    }
}

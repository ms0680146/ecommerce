<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Product;

class ShopController extends Controller
{
    protected $productRepo;
    protected $categoryRepo;

    public function __construct(productRepository $productRepo, categoryRepository $categoryRepo)
    {
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryRepo->getAllCategories();
        $pgCount = config('shop.pagination_count');
        if ($request->category) {
            $categorySlug = $request->category;
            if ($request->sort === 'low_high') {
                $products = $this->productRepo->getProductsByCategorySlug($categorySlug, $pgCount, 'price');
            } elseif ($request->sort == 'high_low') {
                $products = $this->productRepo->getProductsByCategorySlug($categorySlug, $pgCount, 'price', 'DESC');
            } else {
                $products = $this->productRepo->getProductsByCategorySlug($categorySlug, $pgCount);
            }
        } else {
            $categorySlug = 'feature';
            $products = $this->productRepo->getFeatureProducts($pgCount);
        }

        return view('shop', compact('products', 'categories', 'categorySlug'));
    }

    public function show(string $slug)
    {
        $product = $this->productRepo->getProductBySlug($slug);
        $mightAlsoLike = Product::where('slug', '!=', $slug)->inRandomOrder()->take(4)->get(); 
        return view('product', compact('product', 'mightAlsoLike'));
    }
}

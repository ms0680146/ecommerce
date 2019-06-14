<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;

class LandingPageController extends Controller
{
    protected $productRepo;

    public function __construct(productRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        $products = $this->productRepo->getAllProducts(16);
        return view('landing-page', compact('products'));
    }
}

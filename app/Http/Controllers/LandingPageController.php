<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Services\ProductBrowseService;

class LandingPageController extends Controller
{
    protected $productRepo;
    protected $productBrowseService;

    public function __construct(productRepository $productRepo, ProductBrowseService $productBrowseService)
    {
        $this->productRepo = $productRepo;
        $this->productBrowseService = $productBrowseService;
    }

    public function index()
    {
        $products = $this->productRepo->getFeatureProducts(8);
       
        $browseProductsIdArray = $this->productBrowseService->getBrowseProductsIdArray();
        $browsedProducts = $this->productRepo->getBrowsedProducts($browseProductsIdArray, 8);
      
        return view('pages.landing-page', compact('products', 'browsedProducts'));
    }
}

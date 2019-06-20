<?php

namespace App\Repositories;

use App\Product;

class ProductRepository
{
    public function getFeatureProducts(int $count, string $sortBy = 'created_at', string $orderBy = 'ASC')
    {
        return Product::where('feature', true)->orderBy($sortBy, $orderBy)->orderBy('id')->paginate($count);
    }

    public function getProductBySlug(string $slug)
    {
        return Product::where('slug', $slug)->firstOrFail();
    }

    public function getProductsByCategorySlug(string $slug, int $count, string $sortBy = 'created_at', string $orderBy = 'ASC')
    {
        $products = Product::with('categories')->wherehas('categories', function($query) use($slug) {
            $query->where('slug', $slug);
        })->orderBy($sortBy, $orderBy)->orderBy('id')->paginate($count); 

        return $products;
    }

    public function searchKeywordProducts($keyword, $count = 10, string $sortBy = 'created_at', string $orderBy = 'ASC')
    {
        $products = Product::search($keyword)->orderBy($sortBy, $orderBy)->paginate($count);

        return $products;
    }
}

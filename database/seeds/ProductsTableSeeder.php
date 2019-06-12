<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'MacBook Pro',
            'slug' => 'macbook-pro',
            'detail' => '15吋, 1 TB SSD, 32GB RAM',
            'price' => 45000,
            'description' => '亮麗的 Retina 顯示器, 雙核心 Intel Core i5 處理器, Intel lris Plus Graphics 640, 
                超快速 SSD 儲存裝置, 長達 10 小時電池續航力, 802.11 ac WI-F',
        ]);

        Product::create([
            'name' => 'MacBook Pro 1',
            'slug' => 'macbook-pro 1',
            'detail' => '1 15吋, 1 TB SSD, 32GB RAM',
            'price' => 45000,
            'description' => '1 亮麗的 Retina 顯示器, Intel lris Plus Graphics 640, 
                超快速 SSD 儲存裝置, 長達 10 小時電池續航力, 802.11 ac WI-F',
        ]);

        Product::create([
            'name' => 'MacBook Pro 2',
            'slug' => 'macbook-pro 2',
            'detail' => '2 15吋, 1 TB SSD, 32GB RAM',
            'price' => 45000,
            'description' => '2 雙核心 Intel Core i5 處理器, Intel lris Plus Graphics 640, 
                超快速 SSD 儲存裝置, 長達 10 小時電池續航力, 802.11 ac WI-F',
        ]);

        Product::create([
            'name' => 'MacBook Pro 3',
            'slug' => 'macbook-pro 3',
            'detail' => '3 15吋, 1 TB SSD, 32GB RAM',
            'price' => 45000,
            'description' => '3 Intel lris Plus Graphics 640, 超快速 SSD 儲存裝置, 長達 10 小時電池續航力, 802.11 ac WI-F',
        ]);

    }
}

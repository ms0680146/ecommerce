<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Product;

class ViewProductPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_page_loads_correctly()
    {
        $product = factory(Product::class)->create([
            'name' => 'Laptop 1',
            'slug' => 'laptop-1',
            'detail' => '15 inch, 2 TB SSD, 32GB RAM',
            'price' => 24500,
            'description' => 'This is a description for Laptop 1.',
        ]);

        $response = $this->get('/shop/'.$product->slug);

        $response->assertStatus(200);
        $response->assertSee('Laptop 1');
        $response->assertSee('2 TB SSD');
        $response->assertSee('24500');
        $response->assertSee('This is a description for Laptop 1');
    }
}

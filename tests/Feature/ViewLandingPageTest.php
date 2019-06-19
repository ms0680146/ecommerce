<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Product;

class ViewLandingPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_loads_correctly()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('電子商務');
    }

    public function test_featured_product_is_visible()
    {
        $featuredProduct = factory(Product::class)->create([
            'feature' => true,
        ]);

        $response = $this->get('/');

        $response->assertSee($featuredProduct->name);
        $response->assertSee($featuredProduct->price);

        $notFeaturedProduct = factory(Product::class)->create([
            'feature' => false,
        ]);

        $response = $this->get('/');

        $response->assertDontSee($notFeaturedProduct->name);
        $response->assertDontSee($notFeaturedProduct->price);
    }
}

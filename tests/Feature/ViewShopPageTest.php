<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Product;
use App\Category;

class ViewShopPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_shop_page_loads_correctly()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('feature');
    }

    public function test_Pagination_for_products()
    {
        // Page 1 products
        for ($i=1; $i < 7 ; $i++) {
            factory(Product::class)->create([
                'feature' => true,
                'name' => 'Product '.$i,
            ]);
        }
        // Page 2 products
        for ($i=7; $i < 13 ; $i++) {
            factory(Product::class)->create([
                'feature' => true,
                'name' => 'Product '.$i,
            ]);
        }
        $response = $this->get('/shop');
        $response->assertSee('Product 1');
        $response->assertSee('Product 6');

        $response = $this->get('/shop?page=2');
        $response->assertSee('Product 7');
        $response->assertSee('Product 12');
    }

    public function test_sort_price_for_feature_products()
    {
        factory(Product::class)->create([
            'feature' => true,
            'name' => 'Product Low',
            'price' => 10000,
        ]);
        
        factory(Product::class)->create([
            'feature' => true,
            'name' => 'Product Middle',
            'price' => 15000,
        ]);

        factory(Product::class)->create([
            'feature' => true,
            'name' => 'Product High',
            'price' => 20000,
        ]);

        $response = $this->get('/shop?sort=low_high');
        $response->assertSeeInOrder(['Product Low', 'Product Middle', 'Product High']);

        $response = $this->get('/shop?sort=high_low');
        $response->assertSeeInOrder(['Product High', 'Product Middle', 'Product Low']);
    }

    public function test_show_correct_catrgory_products()
    {
        // Laptop Products
        $laptop1 = factory(Product::class)->create(['name' => 'Laptop 1']);
        $laptop2 = factory(Product::class)->create(['name' => 'Laptop 2']);
        // Laptop Category
        $laptopsCategory = Category::create([
            'name' => 'laptops',
            'slug' => 'laptops',
        ]);

        $laptop1->categories()->attach($laptopsCategory->id);
        $laptop2->categories()->attach($laptopsCategory->id);

         // Desktop Products
        $desktop1 = factory(Product::class)->create(['name' => 'Desktop 1']);
        $desktop2 = factory(Product::class)->create(['name' => 'Desktop 2']);
        // Desktop Category
        $desktopsCategory = Category::create([
            'name' => 'Desktops',
            'slug' => 'desktops',
        ]);

        $desktop1->categories()->attach($desktopsCategory->id);
        $desktop2->categories()->attach($desktopsCategory->id);

        $response = $this->get('/shop?category=laptops');

        $response->assertSee('Laptop 1');
        $response->assertSee('Laptop 2');
        $response->assertDontSee('Desktop 1');
        $response->assertDontSee('Desktop 2');

        $response = $this->get('/shop?category=desktops');

        $response->assertSee('Desktop 1');
        $response->assertSee('Desktop 2');
        $response->assertDontSee('Laptop 1');
        $response->assertDontSee('Laptop 2');
    }
}

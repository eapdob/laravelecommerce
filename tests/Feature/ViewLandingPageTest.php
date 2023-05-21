<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;

class ViewLandingPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function landing_page_loads_correctly()
    {
        $response = $this->get('/');

        // Assert
        $response->assertStatus(200);
        $response->assertSee('Laravel Ecommerce');
        $response->assertSee('Includes multiple products');
    }

    /** @test */
    public function featured_product_is_visible()
    {
        $featuredProduct = Product::factory()->create([
            'featured' => true,
            'name' => 'Laptop 1',
            'price' => 149999,
        ]);

        $response = $this->get('/');

        $response->assertSee($featuredProduct->name);
        $response->assertSee('$1499.99');
    }

    /** @test */
    public function not_featured_product_is_not_visible()
    {
        $notFeaturedProduct = Product::factory()->create([
            'featured' => false,
            'name' => 'Laptop 1',
            'price' => 149999,
        ]);

        $response = $this->get('/');

        $response->assertDontSee($notFeaturedProduct->name);
        $response->assertDontSee('$1499.99');
    }
}

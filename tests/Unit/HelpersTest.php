<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_formatted_price()
    {
        $product = Product::factory()->create([
            'name' => 'Product 1',
            'price' => 29999
        ]);

        $this->assertEquals('$299.99', presentPrice($product->price));
    }
}

<?php

namespace Tests\Browser;

use App\Models\Product;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateCartQuantityTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_item_in_the_cart_can_update_quantity()
    {
        $product = Product::factory()->create([
            'name' => 'Laptop 1',
            'slug' => 'laptop-1',
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/shop/laptop-1')
                ->assertSee('Laptop 1')
                ->click('.button.button-plain')
                ->assertPathIs('/cart')
                ->select('.quantity', 2)
                ->pause(1000)
                ->assertSee('Quantity was updated successfully');
        });
    }
}

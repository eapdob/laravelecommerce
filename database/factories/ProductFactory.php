<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->sentence,
            'slug' => fake()->slug,
            'featured' => false,
            'details' => fake()->sentence(8),
            'price' => fake()->numberBetween(1000, 500000),
            'description' => fake()->paragraph,
            'image' => 'products/dummy/laptop-1.jpg',
            'images' => '["products\/dummy\/laptop-2.jpg","products\/dummy\/laptop-3.jpg","products\/dummy\/laptop-4.jpg"]',
            'quantity' => 10,
        ];
    }
}

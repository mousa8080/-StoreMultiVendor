<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Store;

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
    public function definition(): array
    {
        $name = fake()->unique()->productName();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(6),
            'image' => fake()->imageUrl(300, 300),
            'price' => fake()->randomFloat(2, 10, 499),
            'compare_price' => fake()->randomFloat(2, 500, 999),
            'rating' => fake()->randomFloat(2, 0, 5),
            'featured' => fake()->boolean(),
            'category_id' => Category::inRandomOrder()->first()->id,
            'store_id' => Store::inRandomOrder()->first()->id,
        ];
    }
}

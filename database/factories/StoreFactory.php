<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name=fake()->words(5, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(6),
            'logo' => fake()->imageUrl(300,300),
            'cover' => fake()->imageUrl(800,600),
            
        ];
    }
}

<?php

namespace Database\Factories;

use Bezhanov\Faker\Laravel\FakerServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->unique()->phoneNumber(),
            'username' => fake()->unique()->userName(),
            'password' => Hash::make('password'),
            'status' => fake()->randomElement(['active', 'inactive']),
            'super_admin' => fake()->boolean(),

        ];
    }
}

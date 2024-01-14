<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'user_id' => 1,
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'address' => fake()->address(),
            'shop_description' => Str::random(100),
            'store_status' => 'Open',
        ];
    }
}

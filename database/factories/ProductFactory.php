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
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(rand(1, 5), true),

            'price' => fake()->randomFloat(
                nbMaxDecimals: 2, max: pow(10, 7)
            ),
            'quantity' => fake()->numberBetween(0, 1000)
        ];
    }


}

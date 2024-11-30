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
            'category_id' => mt_rand(1,4),
            'name' => $this->faker->sentence(mt_rand(1, 3)),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->sentence(mt_rand(3,10)),
            'price' => $this->faker->numberBetween(10000, 30000)
        ];
    }
}

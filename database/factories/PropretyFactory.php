<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proprety>
 */
class PropretyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'price' => $this->faker->randomNumber(5),
            'size' => $this->faker->randomNumber(3),
            'bedrooms' => $this->faker->numberBetween(1, 8),
            'bathrooms' => $this->faker->numberBetween(1, 5),
            'description' => $this->faker->sentence,
            'category_id' => rand(1, 4),
            'listing_type_id' => rand(1, 2),
            'user_id' => rand(4, 9), 
        ];
    }
}

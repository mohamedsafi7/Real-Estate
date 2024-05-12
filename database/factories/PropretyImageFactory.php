<?php

namespace Database\Factories;

use App\Models\PropretyImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropretyImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PropretyImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'property_id' => function () {
                return \App\Models\Proprety::factory()->create()->id;
            },
            'image_path' => $this->faker->imageUrl(),
        ];
    }
}
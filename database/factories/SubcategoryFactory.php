<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => rand(1, 6),
            'title' => $this->faker->words(rand(2, 4), true),
            'image' => $this->faker->imageUrl(500, 500)
        ];
    }
}

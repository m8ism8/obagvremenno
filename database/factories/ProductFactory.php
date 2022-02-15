<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price = rand(1000, 30000);
        return [
            'code' => $this->faker->bankAccountNumber,
            'title' => $this->faker->words(rand(3, 8), True),
            'price' => $price,
            'new_price' => $this->faker->optional($weight = 0.3)->numberBetween($price/2, $price-500),
            'available' => 1,
            'characteristics' => $this->faker->randomHtml(2,3),
            'description' => $this->faker->randomHtml(2,3),
            'subcategory_id' => rand(1, 30),
            'image' => $this->faker->imageUrl(1000, 1000)
        ];
    }
}

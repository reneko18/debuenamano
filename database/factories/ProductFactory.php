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
    public function definition()
    {
        return [
            'name' => fake()->realTextBetween(10,25),
            'sku' => 'DBN-' . fake()->randomNumber(3,true),
            'price' => fake()->randomNumber(5,true),
            'description' => fake()->realText(180),
            'brand' => fake()->company(),    
            'used_time' => fake()->numberBetween(2,true) . ' meses',
            'status_id' => fake()->numberBetween(1,5),
            'category_id' => fake()->numberBetween(1,46),
            'length' => fake()->randomNumber(2,true),
            'width' => fake()->randomNumber(2,true),
            'height' => fake()->randomNumber(2,true),
            'weight' => fake()->randomNumber(2,true),
            'remark' => fake()->realText(180),
            'advice' => fake()->realText(180),
            'user_id' => fake()->numberBetween(1,10),
        ];
    }
}

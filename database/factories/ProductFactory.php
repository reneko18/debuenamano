<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $genre = fake()->randomElement(['Niño', 'Niña', 'Unisex']); 
        $randomString = fake()->bothify('??????');
        $sku = 'DBM-' . $randomString;      
    

        return [
            'name' => 'Producto Test Plantilla',
            'category_id' => fake()->numberBetween(1,46),
            'genre'=> $genre,
            'age_ini' => 1,
            'age_date_ini' => 'Meses',
            'age_fin' => 2,
            'age_date_fin' => 'Meses',
            'description' => fake()->realText(200),
            'brand' => fake()->company(), 
            'model' => fake()->realTextBetween(10,25),
            'length_real' => fake()->numberBetween(1,100),
            'length_real_unit' => 'cm',
            'width_real' => 50,
            'width_real_unit' => 'cm',
            'height_real' => 50,
            'height_real_unit' => 'cm',
            'status' => 'Usado en buen estado',
            'used_time' => fake()->numberBetween(1,31),
            'used_time_unit' => 'Dias',
            'remark' => fake()->realTextBetween(10,25),
            'advice' => fake()->realTextBetween(10,25),
            'price' => 65000,
            'user_id' => 2,
            'publish_status' => 'En vitrina',
            'selling_status' => '',
            'admin_status' => '',     
            'visible_status' => '',     
            'payment_status' => '',     
            'payment_date' => '',     
            'sku' => $sku,
            'slug' => 'test-product-dbm',
            'meta_title' => 'Test Product DBM',
            'meta_description' => fake()->realText(200),
            'main_step' => json_encode(["1", "2", "3", "4"]),
            'active_title' => 4,
            'received_constant' => 5,
            'current_step' => 9,
        ];
    }
}

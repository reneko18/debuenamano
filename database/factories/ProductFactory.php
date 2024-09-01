<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        $randomString = fake()->bothify('??????');
        $sku = 'DBM-TEST-' . $randomString; 
        $categoryIds = [1, 3, 4, 6, 7, 8, 9, 11, 12, 13, 14, 15, 16, 18, 19, 20, 21, 22, 23, 25, 26, 27, 28, 30, 31, 32, 34, 35, 36, 38, 39, 40, 41, 43, 44, 45, 46];
        $ageFilter = fake()->numberBetween(1,5);  

        $createdAt = fake()->dateTimeBetween('-1 year', 'now');

        return [
            'name' => 'Producto Test Plantilla',
            'category_id' => fake()->randomElement($categoryIds),
            'age_filter_id' => $ageFilter,
            'gender_id'=> fake()->numberBetween(1,3),
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
            'price' => fake()->numberBetween(10000, 100000),
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
            'created_at' => $createdAt,
            'updated_at' => $createdAt, 
            'published_at' => $createdAt,
        ];
    }

    public function withNameSequence()
    {
        return $this->state(new Sequence(
            fn ($sequence) => [
                'name' => 'Producto Test Plantilla ' . ($sequence->index + 1),
                'meta_title' => 'Producto Test Plantilla ' . ($sequence->index + 1),
                'slug' => 'producto-test-plantilla-' . ($sequence->index + 1)
            ]
        ));
    }
}

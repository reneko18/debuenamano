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
        $dateTime = fake()->randomElement(['Recién nacido','Semanas','Meses','Años']);
        $unit = fake()->randomElement(['cm','in']);
        $unitW = fake()->randomElement(['g','Kg']);
        $deliveryBox = fake()->randomElement(['Pequeño','Standard','Grande','Extra']);
        $publish_status = fake()->randomElement(['En vitrina','En revisión','Guardado/borrador']);
        $selling_status = fake()->randomElement(['Sí','Pendiente']);
        $admin_status = fake()->randomElement(['Vendido','En courier', 'Entregado','Finalizado']);
        $randomString = fake()->bothify('??????');
        $sku = 'DBM-' . $randomString;
        $status = fake()->randomElement(['Usado en buen estado','Sin uso']);
    

        return [
            'name' => fake()->realTextBetween(10,25),
            'category_id' => fake()->numberBetween(1,46),
            'genre'=> $genre,
            'age_ini' => fake()->numberBetween(1,52),
            'age_date_ini' => $dateTime,
            'age_fin' => fake()->numberBetween(1,52),
            'age_date_fin' => $dateTime,
            'description' => fake()->realText(180),
            'brand' => fake()->company(), 
            'model' => fake()->realTextBetween(10,25),
            'length' => fake()->numberBetween(1,100),
            'length_unit' => $unit,
            'width' => fake()->numberBetween(1,100),
            'width_unit' => $unit,
            'height' => fake()->numberBetween(1,100),
            'height_unit' => $unit,
            'weight' => fake()->numberBetween(1,100),
            'weight_unit' => $unitW,
            'delivery_box' =>$deliveryBox,
            'status' => $status,
            'used_time' => fake()->numberBetween(1,31),
            'used_time_unit' => 'Dias',
            'remark' => fake()->realTextBetween(10,25),
            'advice' => fake()->realTextBetween(10,25),
            'price' => fake()->randomNumber(5,true),
            'user_id' => fake()->numberBetween(1,10),
            'publish_status' => $publish_status,
            'selling_status' => $selling_status,
            'admin_status' => $admin_status,     
            'sku' => $sku,
            'slug' => Str::slug(fake()->realTextBetween(10,25)),
            'meta_title' => fake()->realTextBetween(5,10),
            'meta_description' => fake()->realText(180),
        ];
    }
}

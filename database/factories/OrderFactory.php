<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = fake()->randomElement(['Reservador', 'Comprado', 'En courier', 'Recibido','Finalizado']);
        return [
            'user_id' => fake()->numberBetween(1,10),
            'product_id' => fake()->numberBetween(1,40),
            'status' => $status,
        ];
    }
}

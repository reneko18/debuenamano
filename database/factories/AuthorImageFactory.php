<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuthorImage>
 */
class AuthorImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        static $number = 1;

        return [
            'author_id' => $number++,
            'url' => fake()->imageUrl(360, 360, 'animals', true, 'cats'),
        ];
    }
}

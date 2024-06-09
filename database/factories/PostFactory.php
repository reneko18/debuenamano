<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $createdAt = fake()->dateTimeBetween('-1 year', 'now');

        return [
            'title' => fake()->realTextBetween(5,10),
            'content' => fake()->realText(500),
            'main_img' => 'images/post-main-image/portada_16952527881695900087.jpg',
            'caption_img' => fake()->realTextBetween(10,25),
            'author_id' => fake()->numberBetween(1,10),
            'slug' => Str::slug(fake()->realTextBetween(5,10)),
            'meta_title' => fake()->realTextBetween(5,10),
            'meta_description' => fake()->realText(180),
            'created_at' => $createdAt,
            'updated_at' => $createdAt, // Assuming you want updated_at to be the same as created_at initially
        ];
    }
}

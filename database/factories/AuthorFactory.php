<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $firstName = fake()->unique()->firstName(null);
        $lastName = fake()->unique()->lastName();
        return [
            'firstname' => $firstName,
            'lastname' => $lastName,
            'slug' => Str::slug($firstName . " " . $lastName),
            'main_img' => 'images/author_profil/author-profil.jpg',
        ];
    }
}

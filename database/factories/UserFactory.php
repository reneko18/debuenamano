<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
     
        $name = fake()->firstName();
        $lastname = fake()->lastName();
        $timestamp = now()->timestamp;
    
        return [
            'name' => $name,
            'lastname' => $lastname,
            'email' => fake()->unique()->safeEmail(),
            'slug' => Str::slug($name . '-' . $lastname . '-' . $timestamp),
            'phone' => fake()->randomNumber(8, true),
            'birthdate' => fake()->date('d/m/Y'),
            'email_verified_at' => now(),
            'password' => '$2y$10$1JKjp0qas0YI6bWdiMsVC.fpgesuZ3Mvc694slkKRFSgZeIMdvSBC', 
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function withCustomerRole()
    {
        return $this->afterCreating(function (User $user) {
            $customerRole = Role::where('name', 'customer')->first();

            if ($customerRole) {
                $user->assignRole($customerRole);
            }
        });
    }
}

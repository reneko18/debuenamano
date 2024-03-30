<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\AuthorImage;
use App\Models\Order;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 

        $this->call(RolesTableSeeder::class);
        // User::factory(10)->withCustomerRole()->create();
        User::factory()->create([
            'name'  => 'Admin',
            'lastname'  => 'DBM',
            'email' => 'admin@dbm.cl', 
            'slug' => 'admin-dbm', 
            'password' => Hash::make('admin'), 
            'birthdate' => '',
            'phone' => '',
        ])->assignRole('admin');
        $this->call(CategoriesTableSeeder::class);       
        // $this->call(ProductContactTableSeeder::class);       
        // $this->call(StatusProductsTableSeeder::class);
        // Product::factory(40)->create();
        // Order::factory(20)->create();
        // $this->call(ProductContactProductSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        Author::factory(10)->create();
        $cats = PostCategory::factory(10)->create();
        AuthorImage::factory(10)->create();
        // Create 20 posts and associate each post with a random category
        Post::factory(20)->create()->each(function ($post) use ($cats) {
            $post->postcategories()->attach($cats->random(1)->pluck('id'));
        });
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 
        User::factory(10)->create();
        $this->call(CategoriesTableSeeder::class);
        $this->call(SubCategoriesTableSeeder::class);
        $this->call(StatusProductsTableSeeder::class);
        Product::factory(40)->create();
        $this->call(RegionsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
    }
}

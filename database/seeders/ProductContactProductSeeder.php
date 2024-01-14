<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductContact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductContactProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                // Specify the number of relationships you want to create
                $numberOfRelationships = 50;

                // Create and attach products to product contacts
                ProductContact::all()->each(function (ProductContact $productContact) use ($numberOfRelationships) {
                    $products = Product::factory()->count($numberOfRelationships)->create();
        
                    $productContact->products()->attach($products);
                });
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\AuthorImage;
use App\Models\BankDetail;
use App\Models\Order;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Product;
use App\Models\DeliveryInformation;
use App\Models\ProductGallery;
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
        $user = User::factory()->create([
            'name'  => 'User',
            'lastname'  => 'Test',
            'email' => 'test@dbm.cl', 
            'slug' => 'test-dbm', 
            'password' => Hash::make('testdbm'), 
            'birthdate' => '',
            'phone' => '',
        ])->assignRole('customer');
        // Creating bank details for the user
        BankDetail::create([
            'user_id' => $user->id,
            'full_name' => 'Usuario Test',
            'bank' => 'Banco Santander',
            'account_number' => '123456789',
            'rut' => '12.345.678-9',
            'account_type' => 'Cuenta Corriente',
        ]);
        $this->call(CategoriesTableSeeder::class);       
        $this->call(GenderTableSeeder::class);       
        $this->call(AgeFiltersTableSeeder::class);
        $products = Product::factory()->count(60)->withNameSequence()->create();
        foreach ($products as $product) {
            // Create delivery information for each product
            $deliveryInformation = new DeliveryInformation([
                'product_id' => $product->id, // Assign the product_id
                'length' => 50,
                'length_unit' => 'cm',
                'width' => 50,
                'width_unit' => 'cm',
                'height' => 50,
                'height_unit' => 'cm',
                'weight' => 0.65,
                'weight_unit' => 'kg',
                'option' => 'Domicilio',
                'region_code' => 'R5',
                'region_name' => 'VALPARAISO',
                'city_name' => 'VALPARAISO',
                'city_code' => 'VALP',
                'chile_office' => '',
                'address' => 'Calle Beethoven',
                'address_number' => 23,
                'dpto_house' => 'Condominio X',
                'recover_price' => '',
            ]);
            $deliveryInformation->save(); // Save the delivery information

            // Create product galleries for each product
            $galleryData = [
                [
                    'url' => 'images/products_images/66252e088fe03_ceramique-de-differentes-couleurs.png',
                    'alt' => 'Gallery Image 1',
                    'size' => '0.6 M',
                    'position' => 1,
                ],
                [
                    'url' => 'images/products_images/6626bc1e2886a_dans-une-boutique-de-la-cote-azur.png',
                    'alt' => 'Gallery Image 2',
                    'size' => '0.4 M',
                    'position' => 2,
                ],
            ];
            foreach ($galleryData as $gallery) {
                $productGallery = new ProductGallery(array_merge($gallery, ['product_id' => $product->id]));
                $productGallery->save(); // Save each product gallery
            }
        }
        $this->call(RegionsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        Author::factory(10)->create();
        $cats = PostCategory::factory(10)->create();
        // Create 20 posts and associate each post with a random category
        // Post::factory(20)->create()->each(function ($post) use ($cats) {
        //     $post->postcategories()->attach($cats->random(1)->pluck('id'));
        // });
        Post::factory(30)->create()->each(function ($post) use ($cats) {
            // Attach 2 or 3 random categories to each post
            $post->postCategories()->attach(
                $cats->random(rand(1, 4))->pluck('id')->toArray()
            );
        });
    }
}

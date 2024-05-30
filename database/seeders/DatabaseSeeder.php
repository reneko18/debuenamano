<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\AuthorImage;
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
        User::factory()->create([
            'name'  => 'User',
            'lastname'  => 'Test',
            'email' => 'test@dbm.cl', 
            'slug' => 'test-dbm', 
            'password' => Hash::make('testdbm'), 
            'birthdate' => '',
            'phone' => '',
        ])->assignRole('customer');
        $this->call(CategoriesTableSeeder::class);       
        // $this->call(ProductContactTableSeeder::class);       
        // $this->call(StatusProductsTableSeeder::class);
        $products = Product::factory()->count(30)->withNameSequence()->create();
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
                'dpto_house' => '',
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

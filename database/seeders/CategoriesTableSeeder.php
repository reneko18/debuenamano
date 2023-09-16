<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Accesorios de baño',
        ]);

        Category::create([
            'name' => 'Alimentación del bebé',
        ]);
        Category::create([
            'name' => 'Andadores y Triciclos',
        ]);
        Category::create([
            'name' => 'Cunas y camas',
        ]);
        Category::create([
            'name' => 'Decoración',
        ]);
        Category::create([
            'name' => 'Disfraces infantiles',
        ]);
        Category::create([
            'name' => 'Juguetes, juegos y peluches',
        ]);
        Category::create([
            'name' => 'Lactancia',
        ]);
        Category::create([
            'name' => 'Libros',
        ]);
        Category::create([
            'name' => 'Mobiliario infantil',
        ]);
        Category::create([
            'name' => 'Paseo',
        ]);
        Category::create([
            'name' => 'Transporte del bebé',
        ]);
        Category::create([
            'name' => 'Seguridad y cuidado',
        ]);
        Category::create([
            'name' => 'Otros',
        ]);
    }
}

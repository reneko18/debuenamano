<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcategory::create([
            'category_id' => '2',
            'name' => 'Batidoras y mezcladores',            
        ]);
        Subcategory::create([
            'category_id' => '2',
            'name' => 'Calientamamaderas',            
        ]);
        Subcategory::create([
            'category_id' => '3',
            'name' => 'Andadores',            
        ]);
        Subcategory::create([
            'category_id' => '3',
            'name' => 'Bicicletas',            
        ]);
        Subcategory::create([
            'category_id' => '3',
            'name' => 'Correpasillos',            
        ]);
        Subcategory::create([
            'category_id' => '3',
            'name' => 'Triciclos',            
        ]);
        Subcategory::create([
            'category_id' => '4',
            'name' => 'Cunas',            
        ]);
        Subcategory::create([
            'category_id' => '4',
            'name' => 'Camas infantiles',            
        ]);
        Subcategory::create([
            'category_id' => '4',
            'name' => 'Iluminación',            
        ]);
        Subcategory::create([
            'category_id' => '4',
            'name' => 'Ropa de cuna',            
        ]);
        Subcategory::create([
            'category_id' => '4',
            'name' => 'Ropa de cama infantil',            
        ]);
        Subcategory::create([
            'category_id' => '4',
            'name' => 'Saco de dormir',            
        ]);
        Subcategory::create([
            'category_id' => '5',
            'name' => 'Alfombras',            
        ]);
        Subcategory::create([
            'category_id' => '5',
            'name' => 'Chales',            
        ]);
        Subcategory::create([
            'category_id' => '5',
            'name' => 'Cuadros',            
        ]);
        Subcategory::create([
            'category_id' => '5',
            'name' => 'Lámparas',            
        ]);
        Subcategory::create([
            'category_id' => '5',
            'name' => 'Móviles',            
        ]);
        Subcategory::create([
            'category_id' => '7',
            'name' => 'Juegos de mesa',            
        ]);
        Subcategory::create([
            'category_id' => '7',
            'name' => 'Juguetes',            
        ]);
        Subcategory::create([
            'category_id' => '7',
            'name' => 'Peluches',            
        ]);
        Subcategory::create([
            'category_id' => '9',
            'name' => 'para niños y niñas',            
        ]);
        Subcategory::create([
            'category_id' => '9',
            'name' => 'para cuidadores',            
        ]);
        Subcategory::create([
            'category_id' => '11',
            'name' => 'Bolsos',            
        ]);
        Subcategory::create([
            'category_id' => '11',
            'name' => 'Mat',            
        ]);
        Subcategory::create([
            'category_id' => '11',
            'name' => 'Mudadores',            
        ]);
        Subcategory::create([
            'category_id' => '12',
            'name' => 'Sillas de auto',            
        ]);
        Subcategory::create([
            'category_id' => '12',
            'name' => 'Sillas de paseo',            
        ]);
        Subcategory::create([
            'category_id' => '12',
            'name' => 'Portabebés',            
        ]);
        Subcategory::create([
            'category_id' => '12',
            'name' => 'Coches',            
        ]);
        Subcategory::create([
            'category_id' => '13',
            'name' => 'Monitores para bebés',            
        ]);
        Subcategory::create([
            'category_id' => '13',
            'name' => 'Puertas de seguridad',            
        ]);
        Subcategory::create([
            'category_id' => '13',
            'name' => 'Barandas de cama',            
        ]);
    }
}

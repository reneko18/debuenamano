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
            'parent' => ''
        ]);

        Category::create([
            'name' => 'Alimentación del bebé',
            'parent' => ''
        ]);

        Category::create([
            'name' => 'Calienta mamaderas',
            'parent' => '2'
        ]);
        Category::create([
            'name' => 'Batidoras y mezcladores',
            'parent' => '2'
        ]);
        Category::create([
            'name' => 'Utensilios y cubertería',
            'parent' => '2'
        ]);
        Category::create([
            'name' => 'Artículos de maternidad',
            'parent' => ''
        ]);
        Category::create([
            'name' => 'Lactancia',
            'parent' => '6'
        ]);
        Category::create([
            'name' => 'Libros para madres y padres',
            'parent' => '6'
        ]);
        Category::create([
            'name' => 'Cunas y camas',
            'parent' => ''
        ]);
        Category::create([
            'name' => 'Cunas',
            'parent' => '9'
        ]);
        Category::create([
            'name' => 'Camas infantiles',
            'parent' => '9'
        ]);
        Category::create([
            'name' => 'Iluminación',
            'parent' => '9'
        ]);
        Category::create([
            'name' => 'Ropa de cuna',
            'parent' => '9'
        ]);
        Category::create([
            'name' => 'Ropa de cama infantil',
            'parent' => '9'
        ]);
        Category::create([
            'name' => 'Saco de dormir',
            'parent' => '9'
        ]);
        Category::create([
            'name' => 'Decoración',
            'parent' => ''
        ]);
        Category::create([
            'name' => 'Alfombras',
            'parent' => '16'
        ]);
        Category::create([
            'name' => 'Chales',
            'parent' => '16'
        ]);
        Category::create([
            'name' => 'Cuadros',
            'parent' => '16'
        ]);
        Category::create([
            'name' => 'Lámparas',
            'parent' => '16'
        ]);
        Category::create([
            'name' => 'Móviles',
            'parent' => '16'
        ]);
        Category::create([
            'name' => 'Disfraces infantiles',
            'parent' => ''
        ]);
        Category::create([
            'name' => 'Juguetes, juegos y peluches',
            'parent' => ''
        ]);
        Category::create([
            'name' => 'Juguetes',
            'parent' => '23'
        ]);
        Category::create([
            'name' => 'Peluches',
            'parent' => '23'
        ]);
        Category::create([
            'name' => 'Juegos de mesa',
            'parent' => '23'
        ]);
        Category::create([
            'name' => 'Centro de actividades',
            'parent' => '23'
        ]);
        Category::create([
            'name' => 'Mobiliario infantil',
            'parent' => ''
        ]);
        Category::create([
            'name' => 'Paseo',
            'parent' => ''
        ]);
        Category::create([
            'name' => 'Mat',
            'parent' => '29'
        ]);
        Category::create([
            'name' => 'Mudadores',
            'parent' => '29'
        ]);
        Category::create([
            'name' => 'Bolsos',
            'parent' => '29'
        ]);
        Category::create([
            'name' => 'Transporte del bebé',
            'parent' => ''
        ]);
        Category::create([
            'name' => 'Sillas de auto',
            'parent' => '33'
        ]);
        Category::create([
            'name' => 'Sillas de paseo',
            'parent' => '33'
        ]);
        Category::create([
            'name' => 'Portabebés',
            'parent' => '33'
        ]);
        Category::create([
            'name' => 'Coches',
            'parent' => '33'
        ]);
        Category::create([
            'name' => 'Andadores',
            'parent' => ''
        ]);
        Category::create([
            'name' => 'Andadores',
            'parent' => '38'
        ]);
        Category::create([
            'name' => 'Sillas para comer',
            'parent' => '38'
        ]);
        Category::create([
            'name' => 'Triciclos',
            'parent' => '38'
        ]);
        Category::create([
            'name' => 'Bicicletas',
            'parent' => '38'
        ]);
        Category::create([
            'name' => 'Seguridad y cuidado',
            'parent' => ''
        ]);
        Category::create([
            'name' => 'Monitores para bebés',
            'parent' => '43'
        ]);
        Category::create([
            'name' => 'Puertas de seguridad',
            'parent' => '43'
        ]);
        Category::create([
            'name' => 'Otros',
            'parent' => ''
        ]);
    }
}

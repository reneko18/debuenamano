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
        $categories = [
            'Accesorios de baño',
            'Alimentación del bebé' => [
                'Batidoras y mezcladores',
                'Calientamamaderas',
            ],
            'Andadores y Triciclos' => [
                'Andadores',
                'Bicicletas',
                'Correpasillos',
                'Triciclos',
            ],
            'Cunas y camas' => [
                'Cunas',
                'Camas infantiles',
                'Iluminación',
                'Ropa de cuna',
                'Ropa de cama infantil',
                'Saco de dormir',
            ],
            'Decoración' => [
                'Alfombras',
                'Chales',
                'Cuadros',
                'Lámparas',
                'Móviles',
            ],
            'Disfraces infantiles',
            'Juguetes, juegos y peluches' => [
                'Juegos de mesa',
                'Juguetes',
                'Peluches',
            ],
            'Lactancia',
            'Libros' => [
                'Para niños y niñas',
                'Para cuidadores',
            ],
            'Mobiliario infantil',
            'Paseo' => [
                'Bolsos',
                'Mat',
                'Mudadores',
            ],
            'Transporte del bebé' => [
                'Sillas de auto',
                'Sillas de paseo',
                'Portabebés',
                'Coches',
            ],
            'Seguridad y cuidado' => [
                'Monitores para bebés',
                'Puertas de seguridad',
                'Barandas de cama',
            ],
            'Otros',
        ];

        $this->seedCategories($categories);
    }
    private function seedCategories($categories, $parent = null)
    {
        foreach ($categories as $key => $value) {
            if (is_array($value)) {
                $category = Category::create(['name' => $key, 'parent_id' => $parent]);
                $this->seedCategories($value, $category->id);
            } else {
                Category::create(['name' => $value, 'parent_id' => $parent]);
            }
        }
    }
}

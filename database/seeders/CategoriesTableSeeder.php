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
            'Alimentación' => [
                'Batidoras y mezcladores',
                'Calientamamaderas',
                'Silla para comer',
            ],
            'Baño',
            'Calzado' => [
                'Zapatilla',
                'Botas/Botines/Bototos',
                'Pantuflas',
                'Sandalias',
            ],
            'Cunas y camas' => [
                'Cunas',
                'Camas infantiles',                                
                'Ropa de cuna',
                'Ropa de cama infantil',
                'Saco de dormir',
                'Mecedora',
            ],
            'Decoración' => [
                'Alfombras',
                'Chales',
                'Cuadros',
                'Lámparas',
                'Móviles',
            ],
            'Disfraces infantiles',
            'Juguetes' => [
                'Juegos de mesa',
                'Juguetes',
                'Peluches',
            ],
            'Libros' => [
                'Para niños y niñas',
                'Para cuidadores',
            ],
            'Mobiliario infantil',
            'Paseo' => [
                'Bolsos/Mochilas',
                'Mat',
                'Mudadores',
                'Outdoor',
            ],
            'Sobre ruedas' => [
                'Andadores',
                'Bicicletas',
                'Correpasillos',
                'Triciclos',
                'Scooter',
            ],
            'Transporte' => [
                'Coches',
                'Portabebés',
                'Sillas de auto',
                'Sillas de paseo',               
            ],
            'Seguridad y cuidado' => [
                'Barandas y corrales',
                'Monitores para bebés',
                'Puertas de seguridad',
                'Barandas de cama',
            ],
            'Vestuario' => [
                'Abrigos y chaquetas',
                'Bermudas y short',
                'Blusas, bodys y camisas',
                'Jardineras y enteritos',
                'Pantalones',
                'Pijamas',
                'Poleras y beatles',
                'Trajes de baño',
                'Sweaters, chalecos y polerones',
                'Vestidos y faldas',
                'Otros',
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

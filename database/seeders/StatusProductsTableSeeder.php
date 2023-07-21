<?php

namespace Database\Seeders;

use App\Models\StatusProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusProduct::create([
            'name' => 'Nuevo',
        ]);
        StatusProduct::create([
            'name' => 'Como nuevo',
        ]);
        StatusProduct::create([
            'name' => 'Buen estado',
        ]);
        StatusProduct::create([
            'name' => 'Aceptable',
        ]);
        StatusProduct::create([
            'name' => 'Restaurado',
        ]);
    }
}

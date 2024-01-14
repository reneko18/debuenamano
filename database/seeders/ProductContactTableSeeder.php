<?php

namespace Database\Seeders;

use App\Models\ProductContact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductContact::create([
            'id' => '1',
            'name' => 'Mail',
        ]);
        ProductContact::create([
            'id' => '2',
            'name' => 'Whatsapp',
        ]);
        ProductContact::create([
            'id' => '3',
            'name' => 'Teléfono',
        ]);
    }
}

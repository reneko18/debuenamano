<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gender::create([
            'name' => 'Niño',
        ]);
        Gender::create([
            'name' => 'Niña',
        ]);
        Gender::create([
            'name' => 'Unisex',
        ]);
    }
}

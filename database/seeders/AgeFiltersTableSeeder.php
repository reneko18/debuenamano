<?php

namespace Database\Seeders;

use App\Models\AgeFilter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgeFiltersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AgeFilter::create([
            'name' => 'RN (0 a 3 meses)',
        ]);
        AgeFilter::create([
            'name' => '3 a 12 meses',
        ]);
        AgeFilter::create([
            'name' => '12 a 24 meses',
        ]);
        AgeFilter::create([
            'name' => '2 a 6 años',
        ]);
    }
}

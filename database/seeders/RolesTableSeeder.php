<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          // Create roles
          $roles = ['admin', 'customer']; // Add more roles as needed

          foreach ($roles as $role) {
              Role::create(['name' => $role]);
          }
    }
}

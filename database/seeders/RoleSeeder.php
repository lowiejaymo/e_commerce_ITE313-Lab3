<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::insert([
            ['role' => 'Admin'],
            ['role' => 'Staff'],
            ['role' => 'Customer'],
        ]);
    }
}

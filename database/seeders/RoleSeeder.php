<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            [
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'kasir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Role::insert($roles);
    }
}

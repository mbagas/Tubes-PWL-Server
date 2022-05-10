<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
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
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('123123123'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'kasir',
                'email' => 'kasir@mail.com',
                'password' => bcrypt('123123123'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        User::insert($roles);
    }
}

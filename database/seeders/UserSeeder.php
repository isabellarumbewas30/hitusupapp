<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'thisisadmin@gmail.com',
            'password' => bcrypt('thisisadmin'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'thisisuser@gmail.com',
            'password' => bcrypt('thisisuser'),
            'role' => 'user',
        ]);
        
    }
}

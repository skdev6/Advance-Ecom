<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name'=> 'Admin',
            'role_id'=> 1,
            'email' => 'admin@gmail.com',
            'phone' => '0162253639901',
            'password'=> bcrypt(12345654)
        ]);
        User::insert([
            'name'=> 'User',
            'role_id'=> 2,
            'email' => 'user@gmail.com',
            'phone' => '0182253639901',
            'password'=> bcrypt(12345654)
        ]);
    }
}

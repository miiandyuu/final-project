<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'anggota', 'email' => 'anggota@gmail.com', 'password' => 'aaaaaaaa', 'role' => 'anggota'],
            ['name' => 'staff', 'email' => 'staff@gmail.com', 'password' => 'aaaaaaaa', 'role' => 'staff'],
            ['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => 'aaaaaaaa', 'role' => 'admin']
        ];

        foreach ($data as $item) {
            User::create([
                'name' => $item['name'],
                'email' => $item['email'],
                'password' => Hash::make($item['password']),
                'role' => $item['role'],
            ]);
        }
    }
}

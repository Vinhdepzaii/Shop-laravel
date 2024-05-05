<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'phone' => '0123456789',
            'address' => 'Ha Noi',
            'avatar' => 'https://pbs.twimg.com/media/F2AvhKGaAAIK5ON?format=jpg&name=4096x4096',
            'status' => 'active',
        ];
        \App\Models\User::create($data);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' =>  'Miguel Perdomo',
            'email' => 'miguel@todo.com',
            'password' => bcrypt('password'),
            'verification_code' => '123456',
            'email_verified_at' => now(),
        ]);
    }
}

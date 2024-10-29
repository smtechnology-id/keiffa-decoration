<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@keiffa.com',
            'no_hp' => '081234567890',
            'password' => Hash::make('xEYnws6y'),
            'level' => 'admin',
            'jenis_kelamin' => 'Laki-laki',
        ]);
        User::create([
            'name' => 'User Keiffa',
            'email' => 'user@keiffa.com',
            'no_hp' => '081234567891',
            'password' => Hash::make('xEYnws6y'),
            'level' => 'user',
            'jenis_kelamin' => 'Perempuan',
        ]);
    }
}

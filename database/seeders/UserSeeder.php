<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database with admin users.
     */
    public function run(): void
    {
        // Admin user pertama
        User::create([
            'nickname' => 'Admin',
            'email' => 'admin@deenia.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'gender' => 'male',
            'tanggal_lahir' => '1990-01-15',
            'avatar' => null,
            'total_score' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Admin user kedua (opsional)
        User::create([
            'nickname' => 'Administrator',
            'email' => 'administrator@deenia.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'gender' => 'female',
            'tanggal_lahir' => '1992-05-20',
            'avatar' => null,
            'total_score' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // User regular (contoh)
        User::create([
            'nickname' => 'User Test',
            'email' => 'user@deenia.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'gender' => 'male',
            'tanggal_lahir' => '2000-03-10',
            'avatar' => null,
            'total_score' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

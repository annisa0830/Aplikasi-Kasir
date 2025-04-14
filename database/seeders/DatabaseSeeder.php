<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // Hash password agar aman
            'role_as' => 'admin', // Perbaiki nama field dari 'role' ke 'role_as'
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('kasir123'),
            'role_as' => 'kasir', // Perbaiki nama field
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;

    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // Pastikan password di-hash
            'role_as' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('kasir123'),
            'role_as' => 'kasir',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

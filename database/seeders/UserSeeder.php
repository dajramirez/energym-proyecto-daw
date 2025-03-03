<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
        ]);

        // Clerks (2)
        for ($i = 1; $i <= 2; $i++) {
            User::create([
                'name' => 'Clerk ' . $i,
                'email' => 'clerk' . $i . '@example.com',
                'username' => 'clerk' . $i,
                'password' => Hash::make('password'),
                'role' => User::ROLE_CLERK,
            ]);
        }

        // Trainers (5)
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => 'Entrenador ' . $i,
                'email' => 'trainer' . $i . '@example.com',
                'username' => 'trainer' . $i,
                'password' => Hash::make('password'),
                'role' => User::ROLE_TRAINER,
            ]);
        }

        // Members (15)
        for ($i = 1; $i <= 15; $i++) {
            User::create([
                'name' => 'Miembro ' . $i,
                'email' => 'member' . $i . '@example.com',
                'username' => 'member' . $i,
                'password' => Hash::make('password'),
                'role' => User::ROLE_USER,
            ]);
        }
    }
}

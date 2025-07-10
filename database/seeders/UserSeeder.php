<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(), //jika mengaktifkan mustemailverificated
        ]);
        $superAdmin->assignRole('superadmin');

        // Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(), 
        ]);
        $admin->assignRole('admin');

        // User
        $user = User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(), 
        ]);
        $user->assignRole('user');
    }
}

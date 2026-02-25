<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN 1 - 6
        for ($i = 1; $i <= 6; $i++) {
            User::updateOrCreate(
                ['email' => "admin{$i}@gmail.com"],
                [
                    'name' => "Admin {$i}",
                    'password' => Hash::make('123456'),
                    'role' => 'admin',
                ]
            );
        }

        // PEGAWAI 6 - 1
        for ($i = 6; $i >= 1; $i--) {
            User::updateOrCreate(
                ['email' => "pegawai{$i}@gmail.com"],
                [
                    'name' => "Pegawai {$i}",
                    'password' => Hash::make('123456'),
                    'role' => 'pegawai',
                ]
            );
        }
    }
}

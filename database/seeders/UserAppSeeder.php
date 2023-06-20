<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            ]);

            $user->assignRole('Admin');

            $user = User::firstOrCreate([
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('123456789'),
            ]);

            $user->assignRole('User');
    }
}

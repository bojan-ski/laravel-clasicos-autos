<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'test user',
            'email' => 'test@test.com',
            'phone_number' => '123/456-789',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'safe_word' => 'test',
            'role' => 'app_user',
        ]);
    }
}

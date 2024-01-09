<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@laracamp.com',
            'email_verified_at' => date('Y-m-d H:i:s', time()),
            'password' => 'admin123',
            'is_admin' => true
        ]);
    }
}

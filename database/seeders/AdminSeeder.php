<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@agriculture.com'],   // find user by email
            [
                'name' => 'Admin',
                'password' => '12345678',           // will auto-hash
            ]
        );
    }
}

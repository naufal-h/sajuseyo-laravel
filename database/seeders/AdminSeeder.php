<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Mimin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('adminkren123'),
            'phone' => '081234567890',
            'isAdmin' => true,
        ]);
    }
}

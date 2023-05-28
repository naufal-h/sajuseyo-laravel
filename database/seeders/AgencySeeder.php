<?php

namespace Database\Seeders;

use App\Models\Agency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agency = [
            ['name' => 'SM Ent.'],
            ['name' => 'JYP Ent.'],
            ['name' => 'YG Ent.'],
            ['name' => 'HYBE Corp.'],
            ['name' => 'Cube Ent.'],
            ['name' => 'Others'],
        ];
        Agency::insert($agency);
    }
}

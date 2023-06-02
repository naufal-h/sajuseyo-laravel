<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order_statuses = [
            ['name' => 'confirmed'],
            ['name' => 'paid'],
            ['name' => 'prepared'],
            ['name' => 'delivered'],
            ['name' => 'completed'],
            ['name' => 'cancelled'],

        ];
        OrderStatus::insert($order_statuses);
    }
}

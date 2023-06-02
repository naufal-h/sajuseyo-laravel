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
            ['name' => 'Confirmed'],
            ['name' => 'Paid'],
            ['name' => 'Prepared'],
            ['name' => 'Delivered'],
            ['name' => 'Completed'],
            ['name' => 'Cancelled'],

        ];
        OrderStatus::insert($order_statuses);
    }
}

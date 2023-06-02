<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function orders()
    {
        $orders = Order::all();

        return view('admin.orders.index', compact('orders'));
    }

    public function editOrder(Order $order)
    {
        $order_statuses = OrderStatus::all();
        return view('admin.orders.edit', compact('order', 'order_statuses'));
    }

    public function updateOrder(Order $order)
    {
        $order->orderStatusHistories()->updateOrCreate([
            'order_status_id' => request('order_status_id')
        ]);

        $order->update([
            'order_status_id' => request('order_status_id')
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully');
    }
}

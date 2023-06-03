<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $orders = Order::with('orderItems')->orderBy('created_at', 'desc')->limit(5)->get();
        $products = Product::withCount('orderItems')->orderBy('order_items_count', 'desc')->limit(5)->get();
        $users = User::whereHas('orders')->orderBy('created_at', 'desc')->limit(5)->get();
        return view('admin.dashboard', compact('orders', 'products', 'users'));
    }

    public function orders()
    {
        $orders = Order::Paginate(20);

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

    public function users()
    {
        $users = User::Paginate(20);

        return view('admin.users', compact('users'));
    }
}

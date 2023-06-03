<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

    public function users(Request $request)
    {
        $search = $request->query('search');
        $users = User::where('name', 'LIKE', "%{$search}%")->orWhere('email', 'LIKE', "%{$search}%")->paginate(20);

        return view('admin.users', compact('users'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout()
    {
        $rajaOngkir = new Client();
        $apiKey = '50fccf12764162cd152d016aae5460e1';
        $baseUrl = 'https://api.rajaongkir.com/starter/';
        $addresses = auth()->user()->addresses;

        $address = $addresses->where('is_default', 1)->first();

        $response = $rajaOngkir->request('GET', $baseUrl . 'province?id=' . $address->province, [
            'headers' => [
                'key' => $apiKey,
            ],
        ]);

        $provinceName = json_decode($response->getBody(), true)['rajaongkir']['results']['province'];

        $response = $rajaOngkir->request('GET', $baseUrl . 'city?id=' . $address->city, [
            'headers' => [
                'key' => $apiKey,
            ],
        ]);

        $cityName = json_decode($response->getBody(), true)['rajaongkir']['results']['city_name'];

        $address->province = $provinceName;
        $address->city = $cityName;

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = $cart->cartItems;


        return view('checkout', compact('cartItems', 'address'));
    }

    public function placeOrder(Request $request)
    {
        $rajaOngkir = new Client();
        $apiKey = '50fccf12764162cd152d016aae5460e1';
        $baseUrl = 'https://api.rajaongkir.com/starter/';

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = $cart->cartItems;
        $user = User::find(Auth::id());
        $address = $user->addresses()->where('is_default', 1)->first();

        $response = $rajaOngkir->request('GET', $baseUrl . 'province?id=' . $address->province, [
            'headers' => [
                'key' => $apiKey,
            ],
        ]);

        $provinceName = json_decode($response->getBody(), true)['rajaongkir']['results']['province'];

        $response = $rajaOngkir->request('GET', $baseUrl . 'city?id=' . $address->city, [
            'headers' => [
                'key' => $apiKey,
            ],
        ]);

        $cityName = json_decode($response->getBody(), true)['rajaongkir']['results']['city_name'];

        $address->province = $provinceName;
        $address->city = $cityName;

        $totalAmount = 0;
        $cartItems->each(function ($cartItem) use ($request, &$totalAmount) {
            if ($cartItem->product->discounted_price) {
                $totalAmount += $cartItem->product->discounted_price * $cartItem->quantity;
            } else {
                $totalAmount += $cartItem->product->price * $cartItem->quantity;
            }
        });



        $order = $user->orders()->create([
            'total_amount' => $totalAmount,
            'address_name' => $address->name,
            'address_phone' => $address->phone,
            'address_address' => $address->address,
            'address_city' => $address->city,
            'address_province' => $address->province,
            'address_postal_code' => $address->postal_code,
            'order_statuses_id' => 2,
        ]);

        $order->orderStatusHistories()->create([
            'order_statuses_id' => 1,
        ]);

        $order->orderStatusHistories()->create([
            'order_statuses_id' => 2,
        ]);

        $cartItems->each(function ($cartItem) use ($order) {
            $order->orderItems()->create([
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'items_price' => $cartItem->product->discounted_price ? $cartItem->product->discounted_price * $cartItem->quantity : $cartItem->product->price * $cartItem->quantity,
            ]);
            $product = $cartItem->product;
            $product->stock -= $cartItem->quantity;
            $product->save();
        });

        $cart->delete();

        return redirect()->route('home')->with('success', 'Order placed successfully.');
    }

    public function showOrders()
    {
        $orders = auth()->user()->orders;

        return view('user.orders', compact('orders'));
    }

    public function orderDetails($id)
    {
        $user = User::find(Auth::id());
        $order = $user->orders()->findOrFail($id);

        return view('order-details', compact('order'));
    }
}

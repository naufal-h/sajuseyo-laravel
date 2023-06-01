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
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = $cart->cartItems;
        $totalAmount = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        $user = User::find(Auth::id());

        $order = $user->orders()->create([
            'address_id' => $user->addresses()->where('is_default', 1)->first()->id,
            'total_amount' => $totalAmount,
        ]);

        $cartItems->each(function ($cartItem) use ($order) {
            $order->orderItems()->create([
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'items_price' => $cartItem->product->price * $cartItem->quantity,
            ]);
        });

        $cart->delete();

        return redirect()->route('home')->with('success', 'Order placed successfully.');
    }

    public function orders()
    {
        $orders = auth()->user()->orders;

        return view('orders', compact('orders'));
    }

    public function orderDetails($id)
    {
        $user = User::find(Auth::id());
        $order = $user->orders()->findOrFail($id);

        return view('order-details', compact('order'));
    }
}

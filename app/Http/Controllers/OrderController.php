<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
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

    public function buyNow(Request $request, $productId)
    {
        $courier = $request->input('courier');
        if (!$courier) {
            $courier = 'jne';
        }
        $quantity = $request->input('quantity');
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

        $shippingCost = 0;
        $response = $rajaOngkir->request('POST', $baseUrl . 'cost', [
            'headers' => [
                'key' => $apiKey,
                'content-type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'origin' => 151, // ID Tangsel
                'destination' => $address->city,
                'weight' => 200, // Gram
                'courier' => $courier,
            ],
        ]);

        $shippingCost = json_decode($response->getBody(), true)['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];

        $address->province = $provinceName;
        $address->city = $cityName;

        $product = Product::findOrFail($productId);


        return view('products.buy-now', compact('product', 'address', 'quantity', 'shippingCost', 'courier'));
    }

    public function placeOrderNow(Request $request, $productId)
    {
        $quantity = $request->input('quantity');
        $rajaOngkir = new Client();
        $apiKey = '50fccf12764162cd152d016aae5460e1';
        $baseUrl = 'https://api.rajaongkir.com/starter/';

        $user = Auth::user();
        $user = User::find(Auth::id());
        $address = $user->addresses()->where('is_default', 1)->first();
        $product = Product::findOrFail($productId);

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
        if ($product->discounted_price) {
            $totalAmount += $product->discounted_price * $quantity;
        } else {
            $totalAmount += $product->price * $quantity;
        }

        $order = $user->orders()->create([
            'total_amount' => $totalAmount,
            'address_name' => $address->name,
            'address_phone' => $address->phone,
            'address_address' => $address->address,
            'address_city' => $address->city,
            'address_province' => $address->province,
            'address_postal_code' => $address->postal_code,
            'order_status_id' => 2,
        ]);

        $order->orderStatusHistories()->create([
            'order_status_id' => 1,
        ]);

        $order->orderStatusHistories()->create([
            'order_status_id' => 2,
        ]);


        $order->orderItems()->create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'items_price' => $product->discounted_price ? $product->discounted_price * $quantity : $product->price * $quantity,
        ]);
        $product->stock -= $quantity;
        $product->save();

        return redirect()->route('home')->with('success', 'Order placed successfully.');
    }

    public function checkout(Request $request)
    {
        $courier = $request->input('courier');
        if (!$courier) {
            $courier = 'jne';
        }

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

        $shippingCost = 0;
        $response = $rajaOngkir->request('POST', $baseUrl . 'cost', [
            'headers' => [
                'key' => $apiKey,
                'content-type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'origin' => 151, // ID Tangsel
                'destination' => $address->city,
                'weight' => 200, // Gram
                'courier' => $courier,
            ],
        ]);

        $shippingCost = json_decode($response->getBody(), true)['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];

        $address->province = $provinceName;
        $address->city = $cityName;

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = $cart->cartItems;


        return view('checkout', compact('cartItems', 'address', 'shippingCost', 'courier'));
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
            'order_status_id' => 2,
        ]);

        $order->orderStatusHistories()->create([
            'order_status_id' => 1,
        ]);

        $order->orderStatusHistories()->create([
            'order_status_id' => 2,
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

    public function showOrdersByStatus($id)
    {
        $user = User::find(Auth::id());

        $orders = $user->orders()->where('order_status_id', $id)->get();

        return view('user.orders', compact('orders'));
    }

    public function orderDetails($id)
    {
        $user = User::find(Auth::id());
        $order = $user->orders()->findOrFail($id);

        return view('user.order-details', compact('order'));
    }

    // update order status to completed
    public function completeOrder($id)
    {
        $user = User::find(Auth::id());
        $order = $user->orders()->findOrFail($id);

        $order->orderStatusHistories()->updateOrCreate([
            'order_status_id' => 5,
        ]);

        $order->order_status_id = 5;
        $order->save();

        return redirect()->back()->with('success', 'Order completed successfully.');
    }
}

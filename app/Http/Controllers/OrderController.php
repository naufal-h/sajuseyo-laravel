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
        $quantity = $request->input('quantity');
        $rajaOngkir = new Client();
        $apiKey = '24032e2eab2263da4aea3acc06f045a3';
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

        $shippingCosts = [];
        $couriers = ['jne', 'pos', 'tiki'];

        foreach ($couriers as $courier) {
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
            $shippingCosts[$courier] = $shippingCost;
        }

        $address->province = $provinceName;
        $address->city = $cityName;

        $product = Product::findOrFail($productId);


        return view('products.buy-now', compact('product', 'address', 'quantity', 'shippingCosts', 'couriers'));
    }

    public function placeOrderNow(Request $request, $productId)
    {
        $courier = $request->input('courier');
        $shippingCost = $request->input('shippingCost');
        $quantity = $request->input('quantity');
        $rajaOngkir = new Client();
        $apiKey = '24032e2eab2263da4aea3acc06f045a3';
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
            'shipping_cost' => $shippingCost,
            'courier' => $courier,
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

        return view('orderconfirmed')->with('success', 'Order placed successfully.');
    }

    public function checkout(Request $request)
    {
        $checkedItems = $request->input('checked_items');


        $rajaOngkir = new Client();
        $apiKey = '24032e2eab2263da4aea3acc06f045a3';
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

        $shippingCosts = [];
        $couriers = ['jne', 'pos', 'tiki'];

        foreach ($couriers as $courier) {
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
            $shippingCosts[$courier] = $shippingCost;
        }

        $address->province = $provinceName;
        $address->city = $cityName;

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (empty($checkedItems)) {
            return redirect()->back()->with('error', 'Please select at least one item to checkout.');
        }

        $cartItems = $cart->cartItems()->whereIn('id', $checkedItems)->get();

        $request->session()->put('checked_cart_items', $checkedItems);


        return view('checkout', compact('cartItems', 'address', 'shippingCosts', 'couriers'));
    }

    public function placeOrder(Request $request)
    {
        $checkedItems = $request->session()->get('checked_cart_items');
        $overallSubtotal = $request->input('overallSubtotal');
        $shippingCost = $request->input('shippingCost');
        $courier = $request->input('courier');
        $rajaOngkir = new Client();
        $apiKey = '24032e2eab2263da4aea3acc06f045a3';
        $baseUrl = 'https://api.rajaongkir.com/starter/';

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = $cart->cartItems()->whereIn('id', $checkedItems)->get();
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

        $order = $user->orders()->create([
            'total_amount' => $overallSubtotal,
            'address_name' => $address->name,
            'address_phone' => $address->phone,
            'address_address' => $address->address,
            'address_city' => $address->city,
            'address_province' => $address->province,
            'address_postal_code' => $address->postal_code,
            'order_status_id' => 2,
            'shipping_cost' => $shippingCost,
            'courier' => $courier,
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

        $cart->cartItems()->whereIn('id', $checkedItems)->delete();

        return view('orderconfirmed')->with('success', 'Order placed successfully.');
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

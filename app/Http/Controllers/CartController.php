<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $user = Auth::user();

        $cartItem = Cart::where('user_id', $user->id)->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function removeFromCart($cartItemId)
    {
        $cartItem = Cart::findOrFail($cartItemId);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Product removed from cart successfully.');
    }

    public function showCart(Request $request)
    {
        $user = User::findOrFail($request->user()->id);
        $cartItems = $user->carts()->with('product')->get();
        return view('cart', compact('cartItems'));
    }

    public function increaseQuantity(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->quantity += 1;
        $cartItem->save();

        return redirect()->route('cart.show')->with('success', 'Quantity increased successfully');
    }

    public function decreaseQuantity(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);
        if ($cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();
            return redirect()->route('cart.show')->with('success', 'Quantity decreased successfully');
        } else {
            $cartItem->delete();
            return redirect()->route('cart.show')->with('success', 'Item removed from cart');
        }
    }

    public function updateQuantity(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->quantity = $request->input('quantity');
        $cartItem->save();

        return response()->json(['message' => 'Quantity updated successfully']);
    }
}

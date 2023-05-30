<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\CartItem;
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

        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
            ]);
        }

        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }


        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function removeFromCart($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Product removed from cart successfully.');
    }

    public function showCart(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return view('cart', ['cartItems' => collect()]);
        }

        $cartItems = $cart->cartItems()->with('product')->get();

        return view('cart', compact('cartItems'));
    }

    public function increaseQuantity(Request $request, $cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->quantity++;
        $cartItem->save();

        return redirect()->route('cart.show')->with('success', 'Item quantity increased successfully');
    }

    public function decreaseQuantity(Request $request, $cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);

        if ($cartItem->quantity > 1) {
            $cartItem->quantity--;
            $cartItem->save();
        } else {
            $cartItem->delete();
        }

        return redirect()->route('cart.show')->with('success', 'Item quantity decreased successfully');
    }

    public function updateQuantity(Request $request, $cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $quantity = $request->input('quantity');

        if ($quantity > 0) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
        } else {
            $cartItem->delete();
        }

        return redirect()->route('cart.show')->with('success', 'Item quantity updated successfully');
    }

    public function getCartTotalQuantity()
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        if ($cart) {
            $totalQuantity = $cart->cartItems()->sum('quantity');
        } else {
            $totalQuantity = 0;
        }

        return $totalQuantity;
    }
}

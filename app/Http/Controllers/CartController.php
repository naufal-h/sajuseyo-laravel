<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add a product to the cart
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $user = Auth::user();

        $cartItem = Cart::where('user_id', $user->id)->where('product_id', $product->id)->first();

        if ($cartItem) {
            // Increment the quantity if the product is already in the cart
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Add the product to the cart with quantity 1
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    // Remove a product from the cart
    public function removeFromCart($cartItemId)
    {
        $cartItem = Cart::findOrFail($cartItemId);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Product removed from cart successfully.');
    }

    // Show the cart
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
            // If the quantity is already 1, you may choose to remove the item from the cart instead
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

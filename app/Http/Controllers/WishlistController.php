<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function showWishlist(Request $request)
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('user_id', $user->id)->first();

        if (!$wishlist) {
            $wishlist = Wishlist::create([
                'user_id' => $user->id,
            ]);
        }

        $wishlistItems = $wishlist->wishlistItems()->with('product')->paginate(20);

        return view('wishlist', compact('wishlistItems', 'wishlist'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addToWishlist($productId)
    {
        $product = Product::findOrFail($productId);
        $user = Auth::user();

        $wishlist = Wishlist::where('user_id', $user->id)->first();

        if (!$wishlist) {
            $wishlist = Wishlist::create([
                'user_id' => $user->id,
            ]);
        }

        $wishlistItem = WishlistItem::where('wishlist_id', $wishlist->id)->where('product_id', $product->id)->first();

        if ($wishlistItem) {
        } else {
            WishlistItem::create([
                'wishlist_id' => $wishlist->id,
                'product_id' => $product->id,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to wishlist');
    }

    public function removeFromWishlist($wishlistItemId)
    {
        $wishlistItem = WishlistItem::findOrFail($wishlistItemId);
        $wishlistItem->delete();

        return redirect()->back()->with('success', 'Product removed from wishlist successfully.');
    }
}

<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', function () {
    return redirect('/');
});
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Product routes
Route::get('/category/{categoryId}', [ProductController::class, 'showProductsByCategory'])->name('products.category');
Route::get('/agency/{agencyId}', [ProductController::class, 'showProductsByAgency'])->name('products.agency');
Route::get('/product-details/{product}', [ProductController::class, 'showProducts'])->name('product-details.show');
Route::post('/product-details/add/{productId}', [CartController::class, 'addFromDetail'])->name('detail.cart.add');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');


// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Admin routes
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin', function () {
        return redirect('/admin/dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

    // CRUD Products 
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::resource('products', 'ProductController');

    // Orders List
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders.index');
    Route::get('/admin/orders/{order}/edit', [AdminController::class, 'editOrder'])->name('admin.orders.edit');
    Route::post('/admin/orders/{order}', [AdminController::class, 'updateOrder'])->name('admin.orders.update');
});

// Cart routes
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{cartItemId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::patch('/cart/increase/{cartItemId}', [CartController::class, 'increaseQuantity'])->name('cart.increase');
Route::patch('/cart/decrease/{cartItemId}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');
Route::patch('/cart/update/{cartItemId}', [CartController::class, 'updateQuantity'])->name('cart.update');

// Wishlist routes
Route::get('/wishlist', [WishlistController::class, 'showWishlist'])->name('wishlist.show');
Route::post('/wishlist/add/{productId}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::post('/wishlist/remove/{wishlistItemId}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');

// Help routes
Route::get('/tnc', [HelpController::class, 'tnc'])->name('tnc');
Route::get('/aboutus', [HelpController::class, 'aboutus'])->name('aboutus');
Route::get('/policy', [HelpController::class, 'policy'])->name('policy');

// Address routes
Route::get('/user/address', [AddressController::class, 'index'])->name('addresses.index');
Route::get('/user/address/create', [AddressController::class, 'create'])->name('addresses.create');
Route::post('/user/address', [AddressController::class, 'store'])->name('addresses.store');
Route::get('/user/address/{address}/edit', [AddressController::class, 'edit'])->name('addresses.edit');
Route::post('/user/address/{address}', [AddressController::class, 'update'])->name('addresses.update');
Route::delete('/user/address/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');
Route::post('/user/addresses/{id}/set-default', [AddressController::class, 'setDefault'])->name('addresses.set_default');
Route::get('/cities', [AddressController::class, 'getCities']);
Route::get('/provinces', [AddressController::class, 'getProvinces']);
Route::get('/cities/{provinceId}', [AddressController::class, 'getCitiesByProvince'])->name('cities.by_province');

// Checkout routes
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/checkout/{productId}', [OrderController::class, 'buyNow'])->name('checkout.buy_now');
Route::post('/placeOrder', [OrderController::class, 'placeOrder'])->name('checkout.place_order');
Route::post('/placeOrder/{productId}', [OrderController::class, 'placeOrderNow'])->name('checkout.place_order_now');

// User routes
Route::get('/user/profile', [UserController::class, 'showProfile'])->name('profile');
Route::post('/user/profile/{user}', [UserController::class, 'update'])->name('users.update');
Route::post('/user/profile/{user}/update-profile-picture', [UserController::class, 'updateProfilePicture'])->name('users.updateProfilePicture');
Route::get('/user/orders', [OrderController::class, 'showOrders'])->name('orders');
Route::get('/user/orders/{order}', [OrderController::class, 'orderDetails'])->name('orders.show');
Route::post('/user/orders/{order}/complete', [OrderController::class, 'completeOrder'])->name('orders.complete');

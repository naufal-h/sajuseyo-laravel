<?php

use App\Http\Controllers\AddressController;
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
Route::get('/category/{categoryId}', [ProductController::class, 'showProductsByCategory'])->name('products.category');
Route::get('/agency/{agencyId}', [ProductController::class, 'showProductsByAgency'])->name('products.agency');


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

    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}', [ProductController::class, 'show'])->name('admin.products.show');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::resource('products', 'ProductController');
});

// Cart routes
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::get('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{cartItemId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/remove/{cartItemId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::patch('/cart/increase/{cartItemId}', [CartController::class, 'increaseQuantity'])->name('cart.increase');
Route::patch('/cart/decrease/{cartItemId}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');
Route::patch('/cart/update/{cartItemId}', [CartController::class, 'updateQuantity'])->name('cart.update');

// Wishlist routes
Route::get('/wishlist', [WishlistController::class, 'showWishlist'])->name('wishlist.show');
Route::get('/wishlist/add/{productId}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::post('/wishlist/add/{productId}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist/remove/{wishlistItemId}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
Route::post('/wishlist/remove/{wishlistItemId}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');

// Help routes
Route::get('/tnc', [HelpController::class, 'tnc'])->name('tnc');
Route::get('/aboutus', [HelpController::class, 'aboutus'])->name('aboutus');
Route::get('/policy', [HelpController::class, 'policy'])->name('policy');

// Address routes
Route::get('/address', [AddressController::class, 'index'])->name('addresses.index');
Route::get('/address/create', [AddressController::class, 'create'])->name('addresses.create');
Route::post('/address', [AddressController::class, 'store'])->name('addresses.store');
Route::get('/address/{address}/edit', [AddressController::class, 'edit'])->name('addresses.edit');
Route::post('/address/{address}', [AddressController::class, 'update'])->name('addresses.update');
Route::delete('/address/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');
Route::post('/addresses/{id}/set-default', [AddressController::class, 'setDefault'])->name('addresses.set_default');
Route::get('/cities', [AddressController::class, 'getCities']);
Route::get('/provinces', [AddressController::class, 'getProvinces']);
Route::get('/cities/{provinceId}', [AddressController::class, 'getCitiesByProvince'])->name('cities.by_province');

// Checkout routes
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('checkout.place_order');

// User routes
Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
Route::post('/profile/{user}', [UserController::class, 'update'])->name('users.update');
Route::post('/profile/{user}/update-profile-picture', [UserController::class, 'updateProfilePicture'])->name('users.updateProfilePicture');

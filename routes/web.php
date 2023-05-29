<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

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
Route::post('cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{cartItemId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/{id}/increase-quantity', [CartController::class, 'increaseQuantity'])->name('cart.increase-quantity');
Route::post('/cart/{id}/decrease-quantity', [CartController::class, 'decreaseQuantity'])->name('cart.decrease-quantity');
Route::post('/cart/{id}/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');

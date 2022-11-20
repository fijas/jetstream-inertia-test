<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SiteController::class, 'index'])->name('welcome');

Route::get('/product/{product:id}', [ProductController::class, 'show'])->name('product.show');

Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');

Route::get('/mailable', function () {
    $order = App\Models\Order::find(2);

    return new App\Mail\OrderCreated($order);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');

    Route::post('/order/create', [OrderController::class, 'store'])->name('order.create');

    Route::get('/order', [OrderController::class, 'index'])->name('order');

    Route::get('/order/{order:id}', [OrderController::class, 'show'])->name('order.view');

    Route::delete('/order/{order:id}', [OrderController::class, 'destroy'])->name('order.delete');
});

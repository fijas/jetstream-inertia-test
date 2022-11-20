<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;

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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');

    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');

    Route::post('/order/create', [OrderController::class, 'store'])->name('order.create');

    Route::get('/order', [OrderController::class, 'index'])->name('order');

    Route::get('/order/{order:id}', [OrderController::class, 'show'])->name('order.view');

    Route::delete('/order/{order:id}', [OrderController::class, 'destroy'])->name('order.delete');

    Route::post('/product', [ProductController::class, 'store'])->name('product.store');

    Route::get('/product', [ProductController::class, 'index'])->name('product');

    Route::get('/product/create', [ProductController::class, 'create'])->name('product.new');

    Route::get('/product/edit/{product:id}', [ProductController::class, 'edit'])->name('product.edit');

    Route::patch('/product/{product:id}', [ProductController::class, 'update'])->name('product.update');

    Route::delete('/product/{product:id}', [ProductController::class, 'destroy'])->name('product.delete');

    Route::get('/user', [UserController::class, 'index'])->name('user');
});

Route::middleware([
    config('jetstream.auth_session')
])->group(function () {
    Route::get('/', [SiteController::class, 'index'])->name('welcome');

    Route::get('/product/{product:id}', [ProductController::class, 'show'])->name('product.show');
});

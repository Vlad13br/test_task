<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WatcherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;


Route::get('/', [WatcherController::class, 'index'])->name('watcher.index');
Route::get('/watch/{id}', [WatcherController::class, 'show'])->name('watch.show');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::post('/order', [OrderController::class, 'createOrder'])->name('order.create');
Route::get('/order/history', [OrderController::class, 'orderHistory'])->name('order.history')->middleware('auth');

Route::post('/watch/{watcher_id}/review', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
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

Route::middleware(['auth', 'verified', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/{order}/edit', [OrderController::class, 'edit'])->name('admin.orders.edit');
    Route::put('/admin/orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('/admin/orders/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');

    Route::get('/admin/watchers/create', [AdminController::class, 'createWatcher'])->name('admin.watchers.create');
    Route::post('/admin/watchers', [AdminController::class, 'storeWatcher'])->name('admin.watchers.store');
    Route::get('/admin/{watcher_id}/edit', [AdminController::class, 'edit'])->name('admin.watchers.edit');
    Route::put('/admin/{watcher_id}', [AdminController::class, 'updateWatcher'])->name('admin.watchers.update');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';

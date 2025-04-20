<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::get('/', [ProductController::class, 'index'])->name('watcher.index');
Route::get('/watch/{id}', [ProductController::class, 'show'])->name('watch.show');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::post('/order', [OrderController::class, 'createOrder'])->name('order.create');
Route::get('/order/history', [OrderController::class, 'orderHistory'])->name('order.history')->middleware('auth');

Route::post('/watch/{product_id}/review', [ReviewController::class, 'store'])->name('reviews.store');

Route::middleware(['auth', 'verified', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin/watchers/create', [AdminController::class, 'createWatcher'])->name('admin.watchers.create');
    Route::post('/admin/watchers', [AdminController::class, 'storeWatcher'])->name('admin.watchers.store');
    Route::get('/admin/{product_id}/edit', [AdminController::class, 'edit'])->name('admin.watchers.edit');
    Route::put('/admin/{product_id}', [AdminController::class, 'updateWatcher'])->name('admin.watchers.update');
    Route::delete('/admin/watchers/{watcher}', [AdminController::class, 'destroyWatcher'])->name('admin.watchers.destroy');

});

Route::middleware('auth')->group(function () {
    Route::post('/test-admin', [AdminController::class, 'testAdmin'])->name('admin.test');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.profile');
    Route::delete('/reviews/{review}', [ProductController::class, 'destroyReview'])->name('admin.reviews.destroy');
});

require __DIR__.'/auth.php';

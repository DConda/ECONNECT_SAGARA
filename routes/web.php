<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductImageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

// Authentication routes
Auth::routes();

// Home route (requires authentication)
Route::get('/home', [HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');

// Catalog routes
Route::middleware(['auth'])->group(function () {
    // Catalog
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
    Route::get('/catalog/create', [CatalogController::class, 'create'])->name('product.create');
    Route::post('/catalog', [CatalogController::class, 'store'])->name('product.store');
    Route::get('/catalog/{id}', [CatalogController::class, 'show'])->name('product.show');
    Route::post('/catalog/{id}/favorite', [CatalogController::class, 'toggleFavorite'])->name('product.favorite');
    Route::post('/catalog/{productId}/reviews/{reviewId}/like', [CatalogController::class, 'toggleReviewLike'])->name('review.like');

    // Product Images
    Route::post('/product-images', [ProductImageController::class, 'store'])->name('product.images.store');
    Route::delete('/product-images/{path}', [ProductImageController::class, 'destroy'])->name('product.images.destroy');

    // Favorites
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::post('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.delete-avatar');

    // File Upload
    Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');
    Route::delete('/upload', [UploadController::class, 'destroy'])->name('upload.destroy');
});

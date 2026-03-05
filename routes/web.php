<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DealerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// About
Route::get('/gioi-thieu', [HomeController::class, 'about'])->name('about');

// Products
Route::get('/san-pham', [ProductController::class, 'index'])->name('products.index');
Route::get('/san-pham/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// Categories
Route::get('/danh-muc/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

// Services (Kỹ thuật)
Route::get('/ky-thuat', [ServiceController::class, 'index'])->name('services.index');
Route::get('/ky-thuat/{service:slug}', [ServiceController::class, 'show'])->name('services.show');

// Projects (Dự án)
Route::get('/du-an', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/du-an/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

// Dealer Registration (Đăng ký đại lý)
Route::get('/dang-ky-dai-ly', [DealerController::class, 'index'])->name('dealer.index');
Route::post('/dang-ky-dai-ly', [DealerController::class, 'store'])->name('dealer.store');

// Promotions (Khuyến mãi)
Route::get('/khuyen-mai', [ProductController::class, 'promotions'])->name('promotions');

// Blog / News
Route::get('/tin-tuc', [PostController::class, 'index'])->name('posts.index');
Route::get('/tin-tuc/{post:slug}', [PostController::class, 'show'])->name('posts.show');

// Contact
Route::get('/lien-he', [ContactController::class, 'index'])->name('contact');
Route::post('/lien-he', [ContactController::class, 'store'])->name('contact.store');

// Cart
Route::get('/gio-hang', [CartController::class, 'index'])->name('cart.index');
Route::post('/gio-hang/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/gio-hang/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/gio-hang/remove', [CartController::class, 'remove'])->name('cart.remove');

// Static pages
Route::get('/trang/{page:slug}', [PageController::class, 'show'])->name('pages.show');

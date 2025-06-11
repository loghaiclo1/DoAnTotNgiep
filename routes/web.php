<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;

// Trang chủ
Route::get('/', [HomeController::class, 'index']);

// About
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/about/search', [AboutController::class, 'search'])->name('about.search');
Route::get('/about/{slug}', [AboutController::class, 'show'])->name('about.show');
Route::get('/about/vanhoccodien/ajax', [AboutController::class, 'fetchVanHocCoDien'])->name('about.vanhoccodien.ajax');
Route::get('/about/tamlyhoc/ajax', [AboutController::class, 'tamLyHocAjax'])->name('about.tamlyhoc.ajax');
Route::get('/about/sachthieunhi/ajax', [AboutController::class, 'sachThieuNhiAjax'])->name('about.sachthieunhi.ajax');
Route::get('/about/sachhay/ajax', [AboutController::class, 'sachHayAjax'])->name('about.sachhay.ajax');

// Giỏ hàng & thanh toán
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


// Danh mục
Route::get('/category', [HomeController::class, 'category']);
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

// Chi tiết sản phẩm
Route::get('/sp/{maSach}', [BookController::class, 'productdetail'])->name('book.detail');
Route::get('/productdetail', [HomeController::class, 'productdetail']); // Giữ luôn nếu có lý do dùng khác

// Liên hệ
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Tài khoản
Route::get('/account', [HomeController::class, 'account']);

// Đăng nhập / Đăng ký
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

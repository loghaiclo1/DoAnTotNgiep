<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\VNPayController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;

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
Route::get('/cart/total-quantity', function () {
    return response()->json([
        'total_quantity' => session('cart_total_quantity', 0)
    ]);
});
Route::get('/cart/quantity', [CartController::class, 'getCartQuantity']);
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/remove/{bookId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('cart/merge', [CartController::class, 'mergeCart'])->name('cart.merge');
Route::post('/cart/check-stock', [CartController::class, 'checkStock']);
// Danh mục
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

// Chi tiết sản phẩm
Route::get('/sp/{slug}', [BookController::class, 'productdetail'])->name('product.detail');

// Liên hệ
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Tài khoản
Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');
});

// Đăng nhập / Đăng ký
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/search', [BookController::class, 'search']);
Route::get('/search-results', [BookController::class, 'searchResults'])->name('search.results');
Route::get('/search-suggestions', [BookController::class, 'searchSuggestions']);
Route::post('/user/addresses', [AddressController::class, 'store'])->name('user.addresses.store');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::post('/vnpay/create-payment', [VNPayController::class, 'createPayment'])->name('vnpay.payment')->middleware('web');
Route::get('/vnpay/return', [VNPayController::class, 'paymentReturn'])
    ->name('vnpay.return')
    ->middleware('web');
Route::post('/promo/apply', [PromoController::class, 'apply'])->name('promo.apply');

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
});
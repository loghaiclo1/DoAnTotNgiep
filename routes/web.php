<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAccountStatus;
use App\Events\AccountLocked;
use App\Http\Controllers\Home\{
    HomeController,
    ContactController,
    AboutController,
    AccountController,
    CategoryController,
    BookController,
    RegisterController,
    LoginController,
    CartController,
    CheckoutController,
    APIController,
    VNPayController,
    PromoController,
    AddressController,
    ReviewController
};
use App\Http\Controllers\Auth\{
    ForgotPasswordController,
    ResetPasswordController,
    SocialController
};

use App\Http\Controllers\Admin\{
    DashboardController,
    PhieuNhapController,
    BookController as AdminBookController,
    OrderController,
    ContactController as AdminContactController
};

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// About
Route::prefix('about')->name('about.')->group(function () {
    Route::get('/', [AboutController::class, 'index'])->name('index');
    Route::get('/search', [AboutController::class, 'search'])->name('search');
    Route::get('/{slug}', [AboutController::class, 'show'])->name('show');
    Route::get('/vanhoccodien/ajax', [AboutController::class, 'fetchVanHocCoDien'])->name('vanhoccodien.ajax');
    Route::get('/tamlyhoc/ajax', [AboutController::class, 'tamLyHocAjax'])->name('tamlyhoc.ajax');
    Route::get('/sachthieunhi/ajax', [AboutController::class, 'sachThieuNhiAjax'])->name('sachthieunhi.ajax');
    Route::get('/sachhay/ajax', [AboutController::class, 'sachHayAjax'])->name('sachhay.ajax');
});

// Danh mục
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

// Chi tiết sản phẩm
Route::get('/sp/{slug}', [BookController::class, 'productdetail'])->name('product.detail');
Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');

// Liên hệ
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/orders/{id}/tracking-html', [OrderController::class, 'trackingHtml']);

// Giỏ hàng
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/total-quantity', fn () => response()->json(['total_quantity' => session('cart_total_quantity', 0)]));
    Route::get('/quantity', [CartController::class, 'getCartQuantity']);
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::get('/clear', [CartController::class, 'clear'])->name('clear');
    Route::post('/remove/{bookId}', [CartController::class, 'remove'])->name('remove');
    Route::post('/update', [CartController::class, 'update'])->name('update');
    Route::post('/merge', [CartController::class, 'mergeCart'])->name('merge');
    Route::post('/check-stock', [CartController::class, 'checkStock']);
});

// Tài khoản người dùng (đã đăng nhập)
Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::post('/user/addresses', [AddressController::class, 'store'])->name('user.addresses.store');
    Route::delete('/user/addresses/{id}', [AddressController::class, 'destroy'])->name('user.addresses.destroy');
    Route::put('/user/addresses/{id}', [AddressController::class, 'update'])->name('user.addresses.update');
    Route::put('/account/address/{id}/mac-dinh', [AddressController::class, 'setDefault'])->name('address.setDefault');
    Route::get('/my-reviews', [ReviewController::class, 'index'])->name('review.index');
    Route::get('/my-reviews/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('/my-reviews/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/my-reviews/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
    Route::get('/my-reviews/create', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/my-reviews', [ReviewController::class, 'store'])->name('review.store');

});

// Auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Quên mật khẩu
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Đăng nhập bằng Google
Route::get('/auth/google', [SocialController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

// Tìm kiếm
Route::get('/search', [BookController::class, 'search']);
Route::get('/search-results', [BookController::class, 'searchResults'])->name('search.results');
Route::get('/search-suggestions', [BookController::class, 'searchSuggestions']);

// Thanh toán
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');


Route::post('/vnpay/create-payment', [VNPayController::class, 'createPayment'])->name('vnpay.payment');

Route::get('/vnpay/return', [VNPayController::class, 'paymentReturn'])->name('vnpay.return');

// Mã giảm giá
Route::post('/promo/apply', [PromoController::class, 'apply'])->name('promo.apply');

// Admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update'])->names('orders');
    Route::get('/reviews', fn () => view('admin.reviews'))->name('reviews');
    Route::resource('books', AdminBookController::class)->except(['show']);
    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts');
    Route::put('contacts/{id}/update-status', [AdminContactController::class, 'updateStatus'])->name('contacts.updateStatus');
    Route::resource('phieunhap', PhieuNhapController::class)->only(['index', 'create', 'store', 'show']);
    Route::get('phieunhap/create', [PhieuNhapController::class, 'create'])->name('phieunhap.create');
    Route::post('phieunhap/store', [PhieuNhapController::class, 'store'])->name('phieunhap.store');
    Route::resource('categories', App\Http\Controllers\Admin\DanhMucController::class);
    Route::get('/accounts', [\App\Http\Controllers\Admin\AccountController::class, 'index'])->name('admin.accounts');
    Route::get('/accounts/{id}/edit', [\App\Http\Controllers\Admin\AccountController::class, 'edit'])->name('accounts.edit');
    Route::put('/accounts/{id}', [\App\Http\Controllers\Admin\AccountController::class, 'update'])->name('accounts.update');
    Route::put('/accounts/{id}/toggle', [\App\Http\Controllers\Admin\AccountController::class, 'toggle'])->name('admin.accounts.toggle');


});
Route::middleware(['web', 'auth', 'superadmin'])->get('/test-superadmin', function () {
    return 'Bạn là superadmin!';
});
Route::get('/account/order-status/{id}', [AccountController::class, 'getOrderStatus'])->name('account.order-status');
Route::get('/test-broadcast', function () {
    if (!Auth::check()) {
        return 'Chưa đăng nhập!';
    }

    broadcast(new AccountLocked(auth()->id()));

    return '✅ Đã phát sự kiện AccountLocked cho user ID: ' . auth()->id();
})->middleware('auth');

Route::get('/check-auth', function () {
    return response()->json([
        'auth' => Auth::check(),
        'user' => Auth::user()
    ]);
});

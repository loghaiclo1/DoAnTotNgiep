<?php

use Illuminate\Support\Facades\Route;

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
    AddressController
};

use App\Http\Controllers\Admin\{
    DashboardController,
    PhieuNhapController,
    BookController as AdminBookController,
    OrderController,
    ContactController as AdminContactController
};

// Trang chủ
Route::get('/', [HomeController::class, 'index']);

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
});

// Auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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
    Route::get('/accounts', fn () => view('admin.accounts'))->name('accounts');
    Route::get('/reviews', fn () => view('admin.reviews'))->name('reviews');
    Route::resource('books', AdminBookController::class)->except(['show']);

    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts');
    Route::put('contacts/{id}/update-status', [AdminContactController::class, 'updateStatus'])->name('contacts.updateStatus');

    Route::resource('phieunhap', PhieuNhapController::class)->only(['index', 'create', 'store', 'show']);
    Route::get('phieunhap/create', [PhieuNhapController::class, 'create'])->name('phieunhap.create');
    Route::post('phieunhap/store', [PhieuNhapController::class, 'store'])->name('phieunhap.store');
    Route::resource('categories', App\Http\Controllers\Admin\DanhMucController::class);
});

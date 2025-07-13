<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAccountStatus;
use App\Events\AccountLocked;
use App\Http\Controllers\Home\FooterClientController;
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
    KhuyenMaiController,
    AddressController,
    ReviewController,
    SuggestionController
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
    ContactController as AdminContactController,
    DanhGiaController,
    TacGiaController,
    NhaXuatBanController,
    DonViPhatHanhController
};
use App\Http\Middleware\CheckPermissionByRoute;
use App\Models\DonViPhatHanh;
use App\Models\NhaXuatBan;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// About

// Danh mục
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

// Chi tiết sản phẩm
Route::get('/sp/{slug}', [BookController::class, 'productdetail'])->name('product.detail');
Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
Route::get('/goi-y-sach', [SuggestionController::class, 'getSuggestions'])->name('sach.goi-y');
// Liên hệ

Route::get('/orders/{id}/tracking-html', [OrderController::class, 'trackingHtml']);

Route::post('/orders/cancel', [AccountController::class, 'cancel'])->middleware('auth')->name('orders.cancel');

// Giỏ hàng
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/total-quantity', fn() => response()->json(['total_quantity' => session('cart_total_quantity', 0)]));
    Route::get('/quantity', [CartController::class, 'getCartQuantity'])->name('quantity');
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
    Route::put('/account/update', [AccountController::class, 'update'])->name('account.update');

    Route::post('/user/addresses', [AddressController::class, 'store'])->name('user.addresses.store');
    Route::delete('/user/addresses/{id}', [AddressController::class, 'destroy'])->name('user.addresses.destroy');
    Route::put('/user/addresses/{id}', [AddressController::class, 'update'])->name('user.addresses.update');
    Route::put('/account/address/{id}/mac-dinh', [AddressController::class, 'setDefault'])->name('address.setDefault');

    Route::get('/my-reviews', [ReviewController::class, 'index'])->name('review.index');
    Route::get('/my-reviews/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('/my-reviews/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/my-reviews/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
    // Route::get('/my-reviews/create', [ReviewController::class, 'create'])->name('review.create');
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
Route::post('/khuyenmai/apply', [KhuyenMaiController::class, 'apply'])->name('khuyenmai.apply');
Route::post('/khuyenmai/remove', [KhuyenMaiController::class, 'remove'])->name('khuyenmai.remove');

// Admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin', CheckPermissionByRoute::class])->group(function () {
    Route::get('footer', [App\Http\Controllers\Admin\FooterController::class, 'index'])->name('footer.index');
    Route::get('footer/{id}/edit', [App\Http\Controllers\Admin\FooterController::class, 'edit'])->name('footer.edit');
    Route::put('footer/{id}', [App\Http\Controllers\Admin\FooterController::class, 'update'])->name('footer.update');
    Route::get('footer/create', [App\Http\Controllers\Admin\FooterController::class, 'create'])->name('footer.create');
    Route::post('footer', [App\Http\Controllers\Admin\FooterController::class, 'store'])->name('footer.store');
    Route::delete('footer/{id}', [App\Http\Controllers\Admin\FooterController::class, 'destroy'])->name('footer.destroy');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('orders/cancel-requests', [OrderController::class, 'cancelRequests'])->name('orders.cancel-requests');
    Route::post('orders/cancel-approve', [OrderController::class, 'cancelApprove'])->name('orders.cancel-approve');
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update'])->names('orders');
    Route::get('/reviews', [DanhGiaController::class, 'index'])->name('reviews.index');
    Route::post('/reviews/{id}/approve', [DanhGiaController::class, 'approve'])->name('reviews.approve');
    Route::post('/reviews/{id}/reject', [DanhGiaController::class, 'reject'])->name('reviews.reject');
    Route::delete('/reviews/{id}', [DanhGiaController::class, 'destroy'])->name('reviews.destroy');
    Route::resource('books', AdminBookController::class)->except(['show']);
    Route::delete('books/{id}', [AdminBookController::class, 'destroy'])->name('books.destroy');
    Route::post('books/{id}/restore', [AdminBookController::class, 'restore'])->name('books.restore');
    Route::delete('/admin/books/{id}/force-delete', [AdminBookController::class, 'forceDelete'])->name('books.forceDelete');
    Route::resource('nxb', \App\Http\Controllers\Admin\NhaXuatBanController::class)->parameters(['nxb' => 'MaNXB']);
    Route::delete('nxb/{id}/hide', [NhaXuatBanController::class, 'hide'])->name('nxb.hide');
    Route::post('nxb/{id}/restore', [NhaXuatBanController::class, 'restore'])->name('nxb.restore');
    Route::resource('admin/donviphathanh', DonViPhatHanhController::class)->names('admin.donviphathanh');
    Route::delete('donviphathanh/{id}/hide', [DonViPhatHanhController::class, 'hide'])->name('donviphathanh.hide');
    Route::post('donviphathanh/{id}/restore', [DonViPhatHanhController::class, 'restore'])->name('donviphathanh.restore');
    Route::post('/tacgia/{id}/restore', [TacGiaController::class, 'restore'])->name('tacgia.restore');
    Route::get('/admin/dashboard/export', [DashboardController::class, 'exportPDF'])->name('dashboard.export');

    Route::get('phieunhap', [PhieuNhapController::class, 'index'])->name('phieunhap.index');
    Route::get('phieunhap/create', [PhieuNhapController::class, 'create'])->name('phieunhap.create');
    Route::post('phieunhap', [PhieuNhapController::class, 'store'])->name('phieunhap.store');
    Route::get('phieunhap/{id}', [PhieuNhapController::class, 'show'])->name('phieunhap.show');
    Route::get('phieunhap/{id}/edit', [PhieuNhapController::class, 'edit'])->name('phieunhap.edit');
    Route::put('phieunhap/{id}', [PhieuNhapController::class, 'update'])->name('phieunhap.update');
    Route::delete('phieunhap/{id}', [PhieuNhapController::class, 'destroy'])->name('phieunhap.destroy');

    Route::resource('categories', App\Http\Controllers\Admin\DanhMucController::class);

    Route::get('orders/{mahoadon}/pdf', [OrderController::class, 'exportPdf'])->name('orders.exportPdf');
    Route::get('orders/{mahoadon}/pdf/view', [OrderController::class, 'viewPdf'])->name('orders.viewPdf');

    Route::post('permissions', [\App\Http\Controllers\Admin\PermissionController::class, 'store'])->name('permissions.store');
    Route::delete('permissions/{id}', [\App\Http\Controllers\Admin\PermissionController::class, 'destroy'])->name('permissions.destroy');

    // Chỉ superadmin mới được quản lý tài khoản
    Route::middleware(['is_superadmin'])->group(function () {
        Route::get('/accounts', [\App\Http\Controllers\Admin\AccountController::class, 'index'])->name('accounts.index');
        Route::get('/accounts/{id}/edit', [\App\Http\Controllers\Admin\AccountController::class, 'edit'])->name('accounts.edit');
        Route::put('/accounts/{id}', [\App\Http\Controllers\Admin\AccountController::class, 'update'])->name('accounts.update');
        Route::put('/accounts/{id}/toggle', [\App\Http\Controllers\Admin\AccountController::class, 'toggle'])->name('accounts.toggle');
        // Giao diện phân quyền người dùng
        Route::get('/accounts/{id}/permissions', [\App\Http\Controllers\Admin\UserPermissionController::class, 'edit'])->name('accounts.permissions.edit');
        Route::put('/accounts/{id}/permissions', [\App\Http\Controllers\Admin\UserPermissionController::class, 'update'])->name('accounts.permissions.update');
    });

    Route::resource('tacgia', TacGiaController::class);
    Route::get('tacgia/{id}/books', [TacGiaController::class, 'books'])->name('tacgia.books');
    Route::post('tacgia/quick-add', [TacGiaController::class, 'quickAdd'])->name('tacgia.quick_add');

    Route::resource('nhaxuatban', NhaXuatBanController::class);
    Route::resource('donviphathanh', DonViPhatHanhController::class);
});

Route::get('/account/order-status/{id}', [AccountController::class, 'getOrderStatus'])->name('account.order-status');
Route::get('/{slug}', [FooterClientController::class, 'show'])->name('footer.show');

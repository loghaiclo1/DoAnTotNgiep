    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\ContactController;
    use App\Http\Controllers\AboutController;
    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\BookController;


    Route::get('/', [HomeController::class, 'index']);

    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::get('/about/search', [AboutController::class, 'search'])->name('about.search');
    Route::get('/about/{slug}', [AboutController::class, 'show'])->name('about.show');
    Route::get('/about/vanhoccodien/ajax', [AboutController::class, 'fetchVanHocCoDien'])->name('about.vanhoccodien.ajax');
    Route::get('/about/tamlyhoc/ajax', [AboutController::class, 'tamLyHocAjax'])->name('about.tamlyhoc.ajax');
    Route::get('/about/sachthieunhi/ajax', [AboutController::class, 'sachThieuNhiAjax'])->name('about.sachthieunhi.ajax');
    Route::get('/about/sachhay/ajax', [AboutController::class, 'sachHayAjax'])->name('about.sachhay.ajax');

    Route::get('/cart', [HomeController::class, 'cart']);

    Route::get('/category', [HomeController::class, 'category']);
    Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

    Route::get('/checkout', [HomeController::class, 'checkout']);

    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    Route::get('/sp/{id}', [BookController::class, 'productdetail']);

    Route::get('/account', [HomeController::class, 'account']);

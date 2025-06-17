{{-- @extends('layout.main')

@section('title', 'BookShop - Danh Mục')
@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Danh mục</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href=" {{ uri('/') }} ">Trang chủ</a></li>
                        <li class="current">Danh mục</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">

                <div class="col-lg-4 sidebar">

                    <div class="widgets-container">

                        <!-- Product Categories Widget -->
                        <div class="product-categories-widget widget-item">
                            <ul class="category-tree list-unstyled mb-0">
                                @foreach ($categories as $cat)
                                    <li class="category-item">
                                        <div class="d-flex justify-content-between align-items-center category-header {{ $cat->children->count() ? 'collapsed' : '' }}"
                                            @if($cat->children->count())
                                                data-bs-toggle="collapse"
                                                data-bs-target="#cat-sub-{{ $cat->id }}"
                                                aria-expanded="false"
                                                aria-controls="cat-sub-{{ $cat->id }}"
                                            @endif
                                        >
                                            <a href="{{ route('category.show', ['slug' => $cat->slug]) }}" class="category-link">
                                                {{ $cat->name }}
                                            </a>
                                            @if($cat->children->count())
                                                <span class="category-toggle">
                                                    <i class="bi bi-chevron-down"></i>
                                                    <i class="bi bi-chevron-up"></i>
                                                </span>
                                            @endif
                                        </div>

                                        @if($cat->children->count())
                                            <ul id="cat-sub-{{ $cat->id }}" class="subcategory-list list-unstyled collapse ps-3 mt-2">
                                                @foreach ($cat->children as $child)
                                                    <li>
                                                        <a href="{{ route('category.show', ['slug' => $child->slug]) }}" class="subcategory-link">
                                                            {{ $child->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div><!--/Product Categories Widget -->

                            <form method="GET" action="{{ route('category.index') }}">

                        <!-- Pricing Range Widget -->
                        <div class="pricing-range-widget widget-item">
                            <h3 class="widget-title">Giá sản phẩm</h3>

                            <div class="price-range-container">
                                {{-- Hiển thị khoảng giá đã định dạng --}}
                                <div class="current-range mb-3">
                                    <span class="min-price">{{ number_format($minPrice, 0, ',', '.') }} VND</span>
                                    <span class="max-price float-end">{{ number_format($maxPrice, 0, ',', '.') }} VND</span>
                                </div>

                                {{-- Thanh kéo chọn giá --}}
                                <div class="range-slider">
                                    <div class="slider-track"></div>
                                    <div class="slider-progress"></div>
                                    <input type="range" class="min-range" min="{{ $minPrice }}" max="{{ $maxPrice }}" name="price_min"
                                        value="{{ $minPrice }}" step="1000">
                                    <input type="range" class="max-range" min="{{ $minPrice }}" max="{{ $maxPrice }}" name="price_max"
                                        value="{{ $maxPrice }}" step="1000">
                                </div>

                                {{-- Nhập giá bằng ô input --}}
                                <div class="price-inputs mt-3">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text">VND</span>
                                                <input type="number" name="price_min" class="form-control min-price-input"
                                                    placeholder="Min" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                                                    value="{{ $minPrice }}" step="1000">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text">VND</span>
                                                <input type="number" name="price_max" class="form-control max-price-input"
                                                    placeholder="Max" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                                                    value="{{ $maxPrice }}" step="1000">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Nút áp dụng --}}
                                <div class="filter-actions mt-3">
                                    <button type="submit" class="btn btn-sm btn-primary w-100">Lọc</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">

                    <!-- Category Header Section -->
                    <section id="category-header" class="category-header section">

                        <div class="container" data-aos="fade-up">
                                <!-- Filter and Sort Options -->
                                <div class="filter-container mb-4" data-aos="fade-up" data-aos-delay="100">
                                    <div class="row g-3 align-items-end">
                                        <!-- Tìm kiếm sách -->
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <div class="filter-item search-form">
                                                <label for="productSearch" class="form-label fw-bold">Tìm kiếm sách</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="productSearch" name="search"
                                                        placeholder="Nhập tên sách..." value="{{ request('search') }}">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="bi bi-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Lọc theo giá -->
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <div class="filter-item">
                                                <label for="priceRange" class="form-label fw-bold">Khoảng giá</label>
                                                <select class="form-select" id="priceRange" name="price_range">
                                                    <option value="">Tất cả</option>
                                                    <option value="1" {{ request('price_range') == '1' ? 'selected' : '' }}>Dưới 25.000đ</option>
                                                    <option value="2" {{ request('price_range') == '2' ? 'selected' : '' }}>25.000 - 50.000đ</option>
                                                    <option value="3" {{ request('price_range') == '3' ? 'selected' : '' }}>50.000 - 100.000đ</option>
                                                    <option value="4" {{ request('price_range') == '4' ? 'selected' : '' }}>Trên 100.000đ</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Sắp xếp -->
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <div class="filter-item">
                                                <label for="sortBy" class="form-label fw-bold">Sắp xếp</label>
                                                <select class="form-select" id="sortBy" name="sort">
                                                    <option value="">Mới nhất</option>
                                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá: Thấp → Cao</option>
                                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá: Cao → Thấp</option>
                                                    <option value="bestseller" {{ request('sort') == 'bestseller' ? 'selected' : '' }}>Bán chạy nhất</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Hiển thị mỗi trang -->
                                        <div class="col-12 col-md-6 col-lg-2">
                                            <div class="filter-item">
                                                <label for="itemsPerPage" class="form-label fw-bold">Hiển thị</label>
                                                <select class="form-select" id="itemsPerPage" name="per_page" style="width: 130px">
                                                    <option value="12" {{ request('per_page') == '12' ? 'selected' : '' }}>12 / trang</option>
                                                    <option value="24" {{ request('per_page') == '24' ? 'selected' : '' }}>24 / trang</option>
                                                    <option value="48" {{ request('per_page') == '48' ? 'selected' : '' }}>48 / trang</option>
                                                    <option value="96" {{ request('per_page') == '96' ? 'selected' : '' }}>96 / trang</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                   <!-- Bộ lọc đang áp dụng -->
                                    <div class="row mt-3">
                                        <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                                            <div class="active-filters">
                                                <span class="active-filter-label">Bộ lọc đang áp dụng:</span>
                                                <div class="filter-tags">
                                                    @if(request('search'))
                                                        <span class="filter-tag">
                                                            Từ khóa: "{{ request('search') }}"
                                                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="filter-remove">
                                                                <i class="bi bi-x"></i>
                                                            </a>
                                                        </span>
                                                    @endif

                                                    @if(request('price_range'))
                                                        <span class="filter-tag">
                                                            Giá:
                                                            @switch(request('price_range'))
                                                                @case('1') Dưới 25.000đ @break
                                                                @case('2') 25.000đ - 50.000đ @break
                                                                @case('3') 50.000đ - 100.000đ @break
                                                                @case('4') Trên 100.000đ @break
                                                            @endswitch
                                                            <a href="{{ request()->fullUrlWithQuery(['price_range' => null]) }}" class="filter-remove">
                                                                <i class="bi bi-x"></i>
                                                            </a>
                                                        </span>
                                                    @endif

                                                    @if(request('sort'))
                                                        <span class="filter-tag">
                                                            Sắp xếp:
                                                            @switch(request('sort'))
                                                                @case('price_asc') Giá: Thấp → Cao @break
                                                                @case('price_desc') Giá: Cao → Thấp @break
                                                                @case('bestseller') Bán chạy nhất @break
                                                            @endswitch
                                                            <a href="{{ request()->fullUrlWithQuery(['sort' => null]) }}" class="filter-remove">
                                                                <i class="bi bi-x"></i>
                                                            </a>
                                                        </span>
                                                    @endif

                                                    @if(request()->query())
                                                        <a href="{{ route('category.index') }}" class="btn btn-sm btn-outline-secondary clear-all-btn ms-2">
                                                            Xóa tất cả
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </section><!-- /Category Header Section -->

                    <!-- Category Product List Section -->
                    <section id="category-product-list" class="category-product-list section">

                        <div class="container" data-aos="fade-up" data-aos-delay="100">
                            <div class="row gy-4">
                                @foreach ($books as $book)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="product-box">
                                            <div class="product-thumb">
                                                @if($book->giam_gia)
                                                    <span class="product-label product-label-sale">-{{ $book->giam_gia }}%</span>
                                                @else
                                                    <span class="product-label">New</span>
                                                @endif
                                                <img src="{{ asset( 'image/book/' . $book->HinhAnh) }}" alt="{{ $book->TenSach }}" class="main-img" loading="lazy">
                                                <div class="product-overlay">
                                                    <div class="product-quick-actions">
                                                        <button type="button" class="quick-action-btn"><i class="bi bi-heart"></i></button>
                                                        <button type="button" class="quick-action-btn"><i class="bi bi-arrow-repeat"></i></button>
                                                        <button type="button" class="quick-action-btn"><i class="bi bi-eye"></i></button>
                                                    </div>
                                                    <div class="add-to-cart-container">
                                                        <button type="button" class="add-to-cart-btn">Thêm vào giỏ</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-details">
                                                    <h3 class="product-title"><a href="#">{{ $book->TenSach }}</a></h3>
                                                    <div class="product-price">
                                                        @if($book->GiaGoc && $book->GiaGoc > $book->GiaBan)
                                                            <span class="original">{{ number_format($book->GiaGoc) }}đ</span>
                                                        @endif
                                                        <span class="sale">{{ number_format($book->GiaBan) }}đ</span>
                                                    </div>
                                                </div>
                                                <div class="product-rating-container">
                                                    <div class="rating-stars">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="bi {{ $i <= 4 ? 'bi-star-fill' : 'bi-star' }}"></i>
                                                        @endfor
                                                    </div>
                                                    <span class="rating-number">4.0</span>
                                                </div>
                                                {{-- Màu hoặc các đặc điểm khác --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section><!-- /Category Product List Section -->

                 <!-- Category Pagination Section -->
                    <section id="category-pagination" class="category-pagination section">
                        <div class="container">
                            <nav class="d-flex justify-content-center" aria-label="Page navigation">
                                {{ $books->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-5') }}
                            </nav>
                        </div>
                    </section>
                </div>

            </div>
        </div>

    </main>
@endsection

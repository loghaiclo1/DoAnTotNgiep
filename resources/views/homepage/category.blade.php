 @extends('layout.main')

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
                            </div>
                        </div>

                        <!-- Sắp xếp -->
                        <div class="filter-item mb-4">
                            <h3 class="form-label fw-bold widget-title">Sắp xếp</h3>
                            <div class="form-check-group d-flex flex-wrap text-start" style="display: flex; flex-wrap: wrap;">
                                @php $currentSort = request('sort'); @endphp

                                <div class="form-check" style="width: 50%">
                                    <input class="form-check-input" type="radio" name="sort" value="" {{ $currentSort == '' ? 'checked' : '' }}>
                                    <label class="form-check-label">Mới nhất</label>
                                </div>

                                <div class="form-check" style="width: 50%">
                                    <input class="form-check-input" type="radio" name="sort" value="price_asc" {{ $currentSort == 'price_asc' ? 'checked' : '' }}>
                                    <label class="form-check-label">Giá: Thấp → Cao</label>
                                </div>

                                <div class="form-check" style="width: 50%">
                                    <input class="form-check-input" type="radio" name="sort" value="price_desc" {{ $currentSort == 'price_desc' ? 'checked' : '' }}>
                                    <label class="form-check-label">Giá: Cao → Thấp</label>
                                </div>

                                <div class="form-check" style="width: 50%">
                                    <input class="form-check-input" type="radio" name="sort" value="bestseller" {{ $currentSort == 'bestseller' ? 'checked' : '' }}>
                                    <label class="form-check-label">Bán chạy nhất</label>
                                </div>
                            </div>
                        </div>


                        <!-- Hiển thị mỗi trang -->
                        <div class="filter-item">
                            <h3 class="form-label fw-bold widget-title">Hiển thị</h3>
                            <div class="form-check-group d-flex flex-wrap gap-2" style="display: flex; flex-wrap: wrap;">
                                {{-- Lấy giá trị hiện tại của per_page từ request --}}
                                @php $currentPerPage = request('per_page'); @endphp

                                <div class="form-check form-check-inline" style="width: 40%">
                                    <input class="form-check-input" type="radio" name="per_page" value="12" {{ $currentPerPage == '12' ? 'checked' : '' }}>
                                    <span class="form-check-label">12 / trang</span>
                                </div>

                                <div class="form-check form-check-inline" style="width: 40%">
                                    <input class="form-check-input" type="radio" name="per_page" value="24" {{ $currentPerPage == '24' ? 'checked' : '' }}>
                                    <span class="form-check-label">24 / trang</span>
                                </div>

                                <div class="form-check form-check-inline" style="width: 40%">
                                    <input class="form-check-input" type="radio" name="per_page" value="48" {{ $currentPerPage == '48' ? 'checked' : '' }}>
                                    <span class="form-check-label">48 / trang</span>
                                </div>

                                <div class="form-check form-check-inline" style="width: 40%">
                                    <input class="form-check-input" type="radio" name="per_page" value="96" {{ $currentPerPage == '96' ? 'checked' : '' }}>
                                    <span class="form-check-label">96 / trang</span>
                                </div>
                            </div>
                        </div>

                        {{-- Nút áp dụng --}}
                        <div class="filter-actions mt-3">
                            <button type="submit" class="btn btn-sm btn-primary w-100">Lọc</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">

                    <!-- Category Header Section -->
                    <section id="category-header" class="category-header section">

                        <div class="container" data-aos="fade-up">
                                <!-- Filter and Sort Options -->
                                <div class="filter-container mb-4" data-aos="fade-up" data-aos-delay="100">

                                   <!-- Bộ lọc đang áp dụng -->
                                    <div class="row mt-3">
                                        <div class="col-12 pt-0 mt-0" data-aos="fade-up" data-aos-delay="200">
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
                                        <div class="product-box" style="height: 435px">
                                            <div class="product-thumb" style="position: relative; height: 261.33px;">
                                                @if($book->giam_gia)
                                                    <span class="product-label product-label-sale">-{{ $book->giam_gia }}%</span>
                                                @else
                                                    <span class="product-label"></span>
                                                @endif
                                                <img src="{{ asset('image/book/' . $book->HinhAnh) }}" alt="{{ $book->TenSach }}" style="width: 100%; max-height: 300px; object-fit: cover;">
                                                <div class="product-overlay" data-book-id="{{ $book->MaSach }}">

                                                    <div class="cart-form-area">
                                                        @if ($book->SoLuong <= 0)
                                                            <button class="btn btn-secondary btn-add-to-cart btn-disabled" disabled>
                                                                <i class="bi bi-bag-plus me-2"></i>Hết hàng
                                                            </button>
                                                        @else
                                                            <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                                                @csrf
                                                                <input type="hidden" name="book_id" value="{{ $book->MaSach }}">
                                                                <button class="btn btn-primary btn-add-to-cart" type="submit">
                                                                    <i class="bi bi-bag-plus me-2"></i>Thêm vào giỏ hàng
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-details">
                                                    <h3 class="product-title" style="min-height: 20px"><a href="{{ route('product.detail', $book->slug) }}">{{ $book->TenSach }}</a></h3>
                                                    <div class="product-price">
                                                        @if($book->GiaGoc && $book->GiaGoc > $book->GiaBan)
                                                            <span class="original">{{ number_format($book->GiaGoc) }}đ</span>
                                                        @endif
                                                        <span class="sale">{{ number_format($book->GiaBan) }}đ</span>
                                                    </div>
                                                </div>
                                                <div class="product-rating-container" style="height: 0px;">
                                                    @php
                                                        $rating = $book->avg_rating ?? 0;
                                                        $reviewsCount = $book->reviews_count ?? 0;
                                                    @endphp
                                                    <div class="rating-stars">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($rating >= $i)
                                                                <i class="bi bi-star-fill text-warning"></i>
                                                            @elseif ($rating >= ($i - 0.5))
                                                                <i class="bi bi-star-half text-warning"></i>
                                                            @else
                                                                <i class="bi bi-star text-warning"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <span class="rating-number">{{ $reviewsCount }} đánh giá</span>
                                                </div>
                                                <div style="color: #7A7E7F; margin-bottom: 5px;">Đã bán {{ $book->LuotMua}} </div>

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

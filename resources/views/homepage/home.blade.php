@extends('layout.main')

@section('title', 'BookShop - Trang Chủ')
@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section class="ecommerce-hero-1 hero section" id="hero">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 content-col aos-init aos-animate" data-aos="fade-right" data-aos-delay="100">
                        <div class="content">
                            <h1>Khơi nguồn tri thức – Mỗi ngày một cuốn sách hay</h1>
                            <h5 style="margin-bottom: 1.5rem;">"{{ $randomQuote }}"</h5>
                        </div>
                    </div>

                    <div class="col-lg-6 image-col aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">
                        <div class="hero-image">
                            @php
                                $book1 = $featuredBooks[0] ?? null;
                                $book2 = $featuredBooks[1] ?? null;
                                $book3 = $featuredBooks[2] ?? null;
                            @endphp
                            <a href="{{ route('product.detail', ['slug' => $book3->slug]) }}">
                                <img src="{{ asset('image/book/' . $book3->HinhAnh) }}" alt="{{ $book3->TenSach }}"
                                    class="main-product" loading="lazy" style="max-height: 350px">
                            </a>
                            @if ($book1)
                                <div class="floating-product product-1 aos-init aos-animate" data-aos="fade-up"
                                    data-aos-delay="300">
                                    <a href="{{ route('product.detail', ['slug' => $book1->slug]) }}"
                                        class="d-flex flex-column align-items-center">
                                        <img src="{{ asset('image/book/' . $book1->HinhAnh) }}"
                                            alt="{{ $book1->TenSach }}">
                                        <div class="product-info d-flex flex-column align-items-center">
                                            <h4>{{ $book1->TenSach }}</h4>
                                            <span class="price">{{ number_format($book1->GiaBan, 0, ',', '.') }}₫</span>
                                        </div>
                                    </a>
                                </div>
                            @endif

                            @if ($book2)
                                <div class="floating-product product-2 aos-init aos-animate" data-aos="fade-up"
                                    data-aos-delay="400">
                                    <a href="{{ route('product.detail', ['slug' => $book2->slug]) }}"
                                        class="d-flex flex-column align-items-center">
                                        <img src="{{ asset('image/book/' . $book2->HinhAnh) }}"
                                            alt="{{ $book2->TenSach }}">
                                        <div class="product-info d-flex flex-column align-items-center">
                                            <h4>{{ $book2->TenSach }}</h4>
                                            <span class="price">{{ number_format($book2->GiaBan, 0, ',', '.') }}₫</span>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Hero Section -->

        <!-- Category Cards Section -->
        <section id="category-cards" class="category-cards section" style="background-color: #f8f9fa;">
            <div class="container aos-init" data-aos="fade-up" data-aos-delay="100">
                <div class="category-slider swiper init-swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
                    <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "autoplay": {
                                "delay": 5000,
                                "disableOnInteraction": false
                            },
                            "grabCursor": true,
                            "speed": 600,
                            "slidesPerView": "auto",
                            "spaceBetween": 20,
                            "navigation": {
                                "nextEl": ".swiper-button-next",
                                "prevEl": ".swiper-button-prev"
                            },
                            "breakpoints": {
                                "320": {
                                    "slidesPerView": 2,
                                    "spaceBetween": 15
                                },
                                "576": {
                                    "slidesPerView": 3,
                                    "spaceBetween": 15
                                },
                                "768": {
                                    "slidesPerView": 4,
                                    "spaceBetween": 20
                                },
                                "992": {
                                    "slidesPerView": 5,
                                    "spaceBetween": 20
                                },
                                "1200": {
                                    "slidesPerView": 6,
                                    "spaceBetween": 20
                                }
                            }
                        }
                    </script>
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Khám Phá Danh Mục Sách</h2>
                        <p class="text-muted">Chọn thể loại yêu thích và khám phá kho sách đa dạng tại cửa hàng của chúng tôi.</p>
                    </div>
                    <div class="swiper-wrapper">
                        @foreach ($demDMcha as $category)
                            <div class="swiper-slide">
                                <div class="category-card aos-init" data-aos="fade-up" data-aos-delay="100">
                                    <div class="category-image">
                                        <img src="{{ asset('image/category/' . $category->image) }}"
                                            alt="{{ $category->name }}" class="img-fluid">
                                    </div>
                                    <h3 class="category-title" style="height: 40px">{{ $category->name }}</h3>
                                    <p class="category-count">{{ $category->demsach }} Sách</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                        aria-controls="swiper-wrapper-53e34c62701b4e56"></div>
                    <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"
                        aria-controls="swiper-wrapper-53e34c62701b4e56"></div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
            </div>
        </section><!-- /Category Cards Section -->

        <!-- Sách Bán Chạy -->
        <section id="best-sellers" class="best-sellers section">
            <div class="container section-title aos-init" data-aos="fade-up">
                <h2>Sách Bán Chạy</h2>
                <p>Những cuốn sách được độc giả yêu thích và đánh giá cao</p>
            </div>

            <div class="container aos-init" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    @foreach ($sachbanchay as $index => $book)
                        <div class="col-md-6 col-lg-3 aos-init" data-aos="fade-up"
                            data-aos-delay="{{ 100 + $index * 50 }}">
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="{{ asset('image/book/' . $book->HinhAnh) }}" alt="{{ $book->TenSach }}"
                                        loading="lazy">
                                    <div class="product-actions">
                                        <button class="btn-quickview" type="button" aria-label="Xem nhanh">
                                            <a href=" {{route('product.detail', $book->slug)}} "><i class="bi bi-eye"></i></a>
                                        </button>
                                    </div>
                                </div>

                                <div class="product-info">
                                    <h3 class="product-title" style="height: 20px;">
                                        <a href="{{ route('product.detail', $book->slug) }}">{{ $book->TenSach }}</a>
                                    </h3>
                                    <div class="product-price">
                                        <span class="current-price">{{ number_format($book->GiaBan, 0, ',', '.') }}₫</span>
                                    </div>
                                    <div class="product-quantity">
                                        <span><span class="book-quantity"></span></span>
                                    </div>
                                    @php
                                        $average = number_format($book->avg_rating ?? 0, 1);
                                        $reviewCount = $book->review_count ?? 0;

                                        $fullStars = floor($average);
                                        $halfStar = ($average - $fullStars) >= 0.5;
                                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                    @endphp

                                    <div class="product-rating" style="margin-bottom: 5px">
                                        {{-- Sao đầy --}}
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @endfor

                                        {{-- Nửa sao --}}
                                        @if ($halfStar)
                                            <i class="bi bi-star-half text-warning"></i>
                                        @endif

                                        {{-- Sao rỗng --}}
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="bi bi-star text-warning"></i>
                                        @endfor

                                        <span class="rating-count">({{ $book->reviews_count }} đánh giá)</span>
                                    </div>

                                    <div style="color: #7A7E7F; margin-bottom: 5px;">Đã bán {{ $book->LuotMua}} </div>

                                    <div class="add-to-cart-container" data-book-id="{{ $book->MaSach }}">
                                        @if ($book->SoLuong <= 0)
                                            <button class="btn btn-secondary btn-add-to-cart btn-disabled" disabled>
                                                <i class="bi bi-bag-plus me-2"></i>Hết hàng
                                            </button>
                                        @else
                                            <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                                @csrf
                                                <input type="hidden" name="book_id" value="{{ $book->MaSach }}">
                                                <button class="btn btn-primary btn-add-to-cart" type="submit">
                                                    <i class="bi bi-bag-plus me-2"></i>Thêm vào giỏ
                                                </button>
                                            </form>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Product List Section -->
        <section id="product-list" class="product-list section">
            <div class="container isotope-layout aos-init" data-aos="fade-up" data-aos-delay="100"
                data-default-filter="*" data-layout="masonry" data-sort="original-order">
                <div class="row">
                    <div class="col-12">
                        <div class="product-filters isotope-filters d-flex justify-content-center aos-init"
                            data-aos="fade-up">
                            <ul class="d-flex flex-wrap gap-2 list-unstyled">
                                <div class="container section-title aos-init" data-aos="fade-up">
                                    <h2>Sách Mới Nổi Bật</h2>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row product-container isotope-container aos-init" data-aos="fade-up" data-aos-delay="200">
                    @foreach ($books as $book)
                        <div class="col-md-6 col-lg-3 product-item isotope-item" data-book-id="{{ $book->MaSach }}">
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="{{ asset('image/book/' . $book->HinhAnh) }}" alt="{{ $book->TenSach }}" style="object-fit: cover">

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

                                <div class="product-info">
                                    <h5 class="product-title">
                                        <a href="{{ route('product.detail', ['slug' => $book->slug]) }}">{{ $book->TenSach }}</a>
                                    </h5>
                                    <div class="product-price">
                                        <span class="current-price">{{ number_format($book->GiaBan, 0, ',', '.') }}₫</span>
                                    </div>
                                    <div class="product-quantity">
                                        <span><span class="book-quantity" data-book-id="{{ $book->MaSach }}"></span></span>
                                    </div>
                                    @php
                                        $average = number_format($book->avg_rating ?? 0, 1);
                                        $reviewCount = $book->reviews_count ?? 0;

                                        $fullStars = floor($average);
                                        $halfStar = ($average - $fullStars) >= 0.5;
                                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                    @endphp
                                    <div class="product-rating" style="margin-bottom: 5px">
                                        {{-- Sao đầy --}}
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @endfor 

                                        {{-- Nửa sao --}}
                                        @if ($halfStar)
                                            <i class="bi bi-star-half text-warning"></i>
                                        @endif  

                                        {{-- Sao rỗng --}}
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="bi bi-star text-warning"></i>
                                        @endfor 
                                        <span class="rating-count">({{ $reviewCount }} đánh giá)</span>
                                    </div> 
                                    <div style="color: #7A7E7F; margin-bottom: 5px;">Đã bán {{ $book->LuotMua}} </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


                <!-- Nút xem tất cả -->
                <div class="text-center mt-5 aos-init" data-aos="fade-up">
                    <a href="{{ route('category.index') }}" class="view-all-btn">Xem tất cả sách <i
                            class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </section><!-- /Product List Section -->
    </main>

    @stack('scripts')
@endsection

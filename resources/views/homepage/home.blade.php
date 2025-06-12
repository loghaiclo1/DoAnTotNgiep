
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
                            <span class="promo-badge">Bộ sưu tập mới 2025</span>
                            <h1>Khám phá những <span>cuốn sách hay</span> cho mọi lứa tuổi</h1>
                            <p>Chúng tôi mang đến hàng ngàn đầu sách phong phú về văn học, kỹ năng sống, giáo dục và hơn thế
                                nữa. Cùng bạn nâng tầm tri thức mỗi ngày.</p>
                            <div class="hero-cta">
                                <a href="#shop" class="btn btn-shop">Mua ngay <i class="bi bi-arrow-right"></i></a>
                            </div>
                            <div class="hero-features">
                                <div class="feature-item">
                                    <i class="bi bi-truck"></i>
                                    <span>Giao hàng miễn phí</span>
                                </div>
                                <div class="feature-item">
                                    <i class="bi bi-shield-check"></i>
                                    <span>Thanh toán an toàn</span>
                                </div>
                                <div class="feature-item">
                                    <i class="bi bi-arrow-repeat"></i>
                                    <span>Đổi trả dễ dàng</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 image-col aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">
                        <div class="hero-image">
                            @php
                                $book1 = $featuredBooks[0] ?? null;
                                $book2 = $featuredBooks[1] ?? null;
                                $book3 = $featuredBooks[2] ?? null;
                            @endphp
                            <img src="{{ asset('image/book/' . $book3->HinhAnh) }}" alt="Sách nổi bật" class="main-product"
                                loading="lazy" style="height: 500px">

                            @if ($book1)
                                <div class="floating-product product-1 aos-init aos-animate" data-aos="fade-up"
                                    data-aos-delay="300">
                                    <img src="{{ asset('image/book/' . $book1->HinhAnh) }}" alt="{{ $book1->TenSach }}">
                                    <div class="product-info">
                                        <h4>{{ $book1->TenSach }}</h4>
                                        <span class="price">{{ number_format($book1->GiaBan, 0, ',', '.') }}₫</span>
                                    </div>
                                </div>
                            @endif

                            @if ($book2)
                                <div class="floating-product product-2 aos-init aos-animate" data-aos="fade-up"
                                    data-aos-delay="400">
                                    <img src="{{ asset('image/book/' . $book2->HinhAnh) }}" alt="{{ $book2->TenSach }}">
                                    <div class="product-info">
                                        <h4>{{ $book2->TenSach }}</h4>
                                        <span class="price">{{ number_format($book2->GiaBan, 0, ',', '.') }}₫</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Hero Section -->

        <!-- Info Cards Section -->
        <section id="info-cards" class="info-cards section light-background">
            <div class="container aos-init" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-4 justify-content-center">
                    <!-- Info Card 1 -->
                    <div class="col-12 col-sm-6 col-lg-3 aos-init" data-aos="fade-up" data-aos-delay="200">
                        <div class="info-card text-center">
                            <div class="icon-box">
                                <i class="bi bi-truck"></i>
                            </div>
                            <h3>Giao hàng nhanh chóng</h3>
                            <p>Giao hàng toàn quốc từ 2–5 ngày. Miễn phí với đơn từ 300.000đ.</p>
                        </div>
                    </div><!-- End Info Card 1 -->

                    <!-- Info Card 2 -->
                    <div class="col-12 col-sm-6 col-lg-3 aos-init" data-aos="fade-up" data-aos-delay="300">
                        <div class="info-card text-center">
                            <div class="icon-box">
                                <i class="bi bi-piggy-bank"></i>
                            </div>
                            <h3>Cam kết hoàn tiền</h3>
                            <p>Hoàn tiền 100% nếu sách bị lỗi, hư hỏng hoặc giao sai nội dung.</p>
                        </div>
                    </div><!-- End Info Card 2 -->

                    <!-- Info Card 3 -->
                    <div class="col-12 col-sm-6 col-lg-3 aos-init" data-aos="fade-up" data-aos-delay="400">
                        <div class="info-card text-center">
                            <div class="icon-box">
                                <i class="bi bi-percent"></i>
                            </div>
                            <h3>Ưu đãi hấp dẫn</h3>
                            <p>Giảm giá định kỳ mỗi tuần và các combo sách siêu tiết kiệm.</p>
                        </div>
                    </div><!-- End Info Card 3 -->

                    <!-- Info Card 4 -->
                    <div class="col-12 col-sm-6 col-lg-3 aos-init" data-aos="fade-up" data-aos-delay="500">
                        <div class="info-card text-center">
                            <div class="icon-box">
                                <i class="bi bi-headset"></i>
                            </div>
                            <h3>Hỗ trợ 24/7</h3>
                            <p>Chúng tôi luôn sẵn sàng hỗ trợ qua điện thoại, email và chat.</p>
                        </div>
                    </div><!-- End Info Card 4 -->
                </div>
            </div>
        </section>
        <!-- /Info Cards Section -->

        <!-- Category Cards Section -->
        <section id="category-cards" class="category-cards section">
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
                                    <a href="{{ url('/category/' . $category->slug) }}" class="stretched-link"></a>
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
            <!-- Tiêu đề -->
            <div class="container section-title aos-init" data-aos="fade-up">
                <h2>Sách Bán Chạy</h2>
                <p>Những cuốn sách được độc giả yêu thích và đánh giá cao</p>
            </div>

            <div class="container aos-init" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    @foreach ($sachbanchay as $index => $book)
                        <div class="col-md-6 col-lg-3 aos-init" data-aos="fade-up" data-aos-delay="{{ 100 + $index * 50 }}">
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="{{ asset('image/book/' . $book->HinhAnh) }}" alt="{{ $book->TenSach }}" loading="lazy">
                                    <div class="product-actions">
                                        <button class="btn-wishlist" type="button" aria-label="Thêm vào yêu thích">
                                            <i class="bi bi-heart"></i>
                                        </button>
                                        <button class="btn-quickview" type="button" aria-label="Xem nhanh">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="product-info">
                                    <h3 class="product-title">
                                        <a href="{{ route('product.detail', $book->slug) }}">{{ $book->TenSach }}</a>
                                    </h3>
                                    <div class="product-price">
                                        <span class="current-price">{{ number_format($book->GiaBan, 0, ',', '.') }}₫</span>
                                    </div>
                                    <div class="product-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= 5 - $index ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                        <span class="rating-count">({{ 10 + $index * 5 }} đánh giá)</span>
                                    </div>
                                    @if ($book->SoLuong == 0)
                                        <button class="btn btn-add-to-cart btn-disabled" disabled>
                                            <i class="bi bi-bag-plus me-2"></i>Hết hàng
                                        </button>
                                    @else
                                        <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="book_id" value="{{ $book->MaSach }}">
                                            <button type="submit" class="btn btn-add-to-cart">
                                                <i class="bi bi-bag-plus me-2"></i>Thêm vào giỏ
                                            </button>
                                        </form>
                                    @endif
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

                <!-- Bộ lọc -->
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
     <!-- Danh sách sách -->
     <div class="row product-container isotope-container aos-init" data-aos="fade-up" data-aos-delay="200">
        @foreach ($books as $book)
            <div class="col-md-6 col-lg-3 product-item isotope-item ">
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('./image/book/' . $book->HinhAnh) }}" alt="{{ $book->TenSach }}"
                            style="object-fit: cover">
                        <div class="product-overlay">
                            <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->MaSach }}">
                                <button type="submit" class="btn-cart">
                                    <i class="bi bi-cart-plus"></i> Thêm vào giỏ
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="product-info">
                        <h5 class="product-title"><a href="{{ route('product.detail', ['slug' => $book->slug]) }}">{{ $book->TenSach }}</a></h5>
                        <div class="product-price">
                            <span
                                class="current-price">{{ number_format($book->GiaBan, 0, ',', '.') }}₫</span>
                        </div>
                        <div class="product-rating">
                            {{-- @for ($i = 1; $i <= 5; $i++)
                                <i
                                    class="bi {{ $i <= round($book->LuotMua / 10) ? 'bi-star-fill' : 'bi-star' }}"></i>
                            @endfor --}}
                            <span>( {{ $book->LuotMua }} lượt bán )</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Nút xem tất cả -->
    <div class="text-center mt-5 aos-init" data-aos="fade-up">
        <a href="#" class="view-all-btn">Xem tất cả sách <i class="bi bi-arrow-right"></i></a>
    </div>
</div>


        </section><!-- /Product List Section -->
    </main>

    <!-- Thêm SweetAlert2 và JavaScript cho AJAX -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Xử lý session thông báo (nếu có)
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
        </script>

@endsection

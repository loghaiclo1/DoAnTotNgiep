<!DOCTYPE html>
<!-- saved from url=(0056)# -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', 'BookShop - Trang chủ')</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <meta name="robots" content="noindex, nofollow">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <script>
    @if (Auth::check())
        window.authUserId = {{ Auth::id() }};
    @endif
</script>
@vite(['resources/js/app.js', 'resources/js/account-lock-listener.js'])


  <!-- Favicons -->
  <link href="https://bootstrapmade.com/content/demo/eStore/assets/img/favicon.png" rel="icon">
  <link href="https://bootstrapmade.com/content/demo/eStore/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/" rel="preconnect">
  <link href="https://fonts.gstatic.com/" rel="preconnect" crossorigin="">
  <link href="./css/css2" rel="stylesheet">
  <!-- Vendor CSS Files -->

  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('css/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/drift-basic.css') }}" rel="stylesheet">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  <!-- Main CSS File -->
  <link href="./css/main.css" rel="stylesheet">
  @if (Request::is('about/*') || Request::is('about'))
  <link href="{{ asset('css/about.css') }}" rel="stylesheet">
@endif
  <!-- =======================================================
  * Template Name: eStore
  * Template URL: https://bootstrapmade.com/estore-bootstrap-ecommerce-template/
  * Updated: Apr 26 2025 with Bootstrap v5.3.5
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

<body class="index-page vsc-initialized" data-aos-easing="ease-in-out" data-aos-duration="600" data-aos-delay="0">

  <header id="header" class="header position-fixed top-0 start-0 w-100 z-100 bg-white shadow-sm">

    <!-- Main Header -->
    <div class="main-header">
      <div class="container-fluid container-xl">
        <div class="d-flex py-3 align-items-center justify-content-between">

          <!-- Logo -->
          <a href="{{ url("/")}}" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.webp" alt=""> -->
            <h1 class="sitename">
                {{ $thongTinChung->ten_cong_ty ?? 'BookShop' }}
            </h1>
          </a>

          <!-- Search -->
          <form class="search-form" action="{{ url('/search-results') }}" method="GET" style="min-width: 400px;">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Tìm kiếm sách" required id="search-input" autocomplete="off">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
                <div id="suggestions" class="suggestions-list" style="display: none; position: absolute; top: 100%; left: 0; background: #fff; border: 1px solid #ddd; z-index: 1000; width: 100%; max-height: 300px; overflow-y: auto;"></div>
            </div>
        </form>
          <!-- Actions -->
          <div class="header-actions d-flex align-items-center justify-content-end">

            <!-- Mobile Search Toggle -->
            <button class="header-action-btn mobile-search-toggle d-xl-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSearch" aria-expanded="false" aria-controls="mobileSearch">
              <i class="bi bi-search"></i>
            </button>

            <!-- Account -->
            <div class="dropdown account-dropdown">
              <button class="header-action-btn" data-bs-toggle="dropdown">
                <i class="bi bi-person"></i>
                   @auth
                   <span class="ms-2 d-none d-md-inline" style="font-size: 14px;">
                    {{ Auth::user()->Ho }} {{ Auth::user()->Ten }}
                </span>
                 @endauth
              </button>

              <div class="dropdown-menu">
                  @auth
                      {{-- Trạng thái: Đã đăng nhập --}}
                      <div class="dropdown-header">
                          <h6>Xin chào, <span class="sitename">{{ Auth::user()->Ho }} {{ Auth::user()->Ten }}</span></h6>
                      </div>
                      <div class="dropdown-body">
                          <a class="dropdown-item d-flex align-items-center" href="{{ url('/account') }}">
                              <i class="bi bi-person-circle me-2"></i>
                              <span>Tài khoản</span>
                          </a>
                          <a class="dropdown-item d-flex align-items-center" href=" {{ route('cart.index')}} ">
                              <i class="bi bi-bag-check me-2"></i>
                              <span>Giỏ hàng</span>
                          </a>
                          <a class="dropdown-item d-flex align-items-center" href=" {{ route('account')}}?tab=addresses">
                              <i class="bi bi-geo-alt me-2"></i>
                              <span>Địa chỉ</span>
                          </a>
                          <a class="dropdown-item d-flex align-items-center" href=" {{ route('account')}}?tab=reviews">
                              <i class="bi bi-star me-2"></i>
                              <span>Đánh giá</span>
                          </a>
                          <a class="dropdown-item d-flex align-items-center" href=" {{ route('account')}}?tab=settings">
                              <i class="bi bi-gear me-2"></i>
                              <span>Cài đặt</span>
                          </a>
                      </div>
                      <div class="dropdown-footer">
                          <form action="{{ route('logout') }}" method="POST">
                              @csrf
                              <button class="btn btn-danger w-100" type="submit">Đăng xuất</button>
                          </form>
                      </div>
                  @endauth

                  @guest
                      {{-- Trạng thái: Chưa đăng nhập --}}
                      <div class="dropdown-header">
                          <h6>Chào mừng đến <span class="sitename">   {{ $thongTinChung->ten_cong_ty ?? 'BookShop' }}</span></h6>
                      </div>
                      <div class="dropdown-footer">
                          <a href="{{ url('/login') }}" class="btn btn-primary w-100 mb-2">Đăng nhập</a>
                          <a href="{{ url('/register') }}" class="btn btn-outline-primary w-100">Đăng ký</a>
                      </div>
                  @endguest
              </div>
            </div>

            <a href="{{ url('/cart') }}" class="header-action-btn">
                <i class="bi bi-cart3"></i>
            </a>

            <!-- Mobile Navigation Toggle -->
            <i class="mobile-nav-toggle d-xl-none bi bi-list me-0"></i>

          </div>
        </div>
      </div>
    </div>

    <!-- Navigation -->
    <div class="header-nav">
      <div class="container-fluid container-xl">
        <div class="position-relative">
          <nav id="navmenu" class="navmenu">
            <ul>
              <li><a href=" {{ url('/') }} " class=" {{ request()->is('/') ? 'active' : '' }} ">Trang chủ</a></li>
              {{-- <li><a href=" {{ url('/about') }} ">Giới thiệu</a></li> --}}
              <li><a href=" {{ url('/category') }} " class=" {{ request()->is('category*') ? 'active' : '' }} ">Danh mục</a></li>
              <li><a href=" {{ url('/cart') }} " class=" {{ request()->is('cart') ? 'active' : '' }} ">Giỏ hàng</a></li>
              {{-- <li><a href=" {{ url('/checkout') }} ">Thanh toán</a></li> --}}

              <!-- Products Mega Menu 2 -->
              <li class="products-megamenu-2"><span>Danh mục sách</span> <i class="bi bi-chevron-down toggle-dropdown"></i>

                <!-- Products Mega Menu 2 Mobile View -->
                <ul class="mobile-megamenu">

                  <li><a href="##">Women</a></li>
                  <li><a href="##">Men</a></li>
                  <li><a href="##">Kids'</a></li>

                  <li class="dropdown"><a href="##"><span>Clothing</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="##">Shirts &amp; Tops</a></li>
                      <li><a href="##">Coats &amp; Outerwear</a></li>
                      <li><a href="##">Underwear</a></li>
                      <li><a href="##">Sweatshirts</a></li>
                      <li><a href="##">Dresses</a></li>
                      <li><a href="##">Swimwear</a></li>
                    </ul>
                  </li>

                  <li class="dropdown"><a href="##"><span>Shoes</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="##">Boots</a></li>
                      <li><a href="##">Sandals</a></li>
                      <li><a href="##">Heels</a></li>
                      <li><a href="##">Loafers</a></li>
                      <li><a href="##">Slippers</a></li>
                      <li><a href="##">Oxfords</a></li>
                    </ul>
                  </li>

                  <li class="dropdown"><a href="##"><span>Accessories</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="##">Handbags</a></li>
                      <li><a href="##">Eyewear</a></li>
                      <li><a href="##">Hats</a></li>
                      <li><a href="##">Watches</a></li>
                      <li><a href="##">Jewelry</a></li>
                      <li><a href="##">Belts</a></li>
                    </ul>
                  </li>

                  <li class="dropdown"><a href="##"><span>Specialty Sizes</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="##">Plus Size</a></li>
                      <li><a href="##">Petite</a></li>
                      <li><a href="##">Wide Shoes</a></li>
                      <li><a href="##">Narrow Shoes</a></li>
                    </ul>
                  </li>

                </ul><!-- End Products Mega Menu 2 Mobile View -->

                <!-- Products Mega Menu 2 Desktop View -->
                <div class="desktop-megamenu">

                  <div class="megamenu-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="vn-tab" data-bs-toggle="tab" data-bs-target="#vn-tab-pane" type="button" role="tab">Sách trong nước</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="qt-tab" data-bs-toggle="tab" data-bs-target="#qt-tab-pane" type="button" role="tab">Sách nước ngoài</button>
                      </li>
                    </ul>
                  </div>

                  <!-- Tabs Content -->
                  <div class="megamenu-content tab-content">
                    <!-- Sach VN Tab -->
                   <x-categorymenu
                        :data="$dmWithTop3"
                        tab-id="vn-tab-pane"
                        tab-label="vn-tab"
                        :active="true"
                    />

                    <x-categorymenu
                        :data="$dmWithTop3QT"
                        tab-id="qt-tab-pane"
                        tab-label="qt-tab"
                        :active="false"
                    />
                  </div>
                </div><!-- End Products Mega Menu 2 Desktop View -->
              </li><!-- End Products Mega Menu 2 -->

              <li><a href=" {{ url('/contact') }} " class=" {{ request()->is('contact') ? 'active' : '' }} ">Hỗ trợ</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>

    <!-- Mobile Search Form -->
    <div class="collapse" id="mobileSearch">
      <div class="container">
        <form class="search-form">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for products">
            <button class="btn" type="submit">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </form>
      </div>
    </div>

  </header>

   @yield('content')

   <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
    <div id="loginSuccessToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

   <footer id="footer" class="footer">
    <div class="footer-main" style="background: rgba(10, 77, 184, 0.05)">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-widget footer-about">
                        <a href=" #" class="logo">
                            @if(isset($thongTinChung) && $thongTinChung->logo_url)
                            <span class="sitename fw-bold text-primary" style="font-size: 24px;">
                                <a href="{{ route('home') }}" class="text-decoration-none">
                                <h1 class="sitename">
                                    {{ $thongTinChung->ten_cong_ty ?? 'BookShop' }}
                                </h1>
                                  </a>
                            </span>
                        @else
                        <a href="" class="text-decoration-none">
                        </a>
                        @endif
                        </a>
                        @if(isset($thongTinChung))
                            <p>{{ $thongTinChung->mo_ta }}</p>
                            <div class="footer-contact mt-4">
                                <div class="contact-item">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>{{ $thongTinChung->dia_chi }}</span>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-telephone"></i>
                                    <span>{{ $thongTinChung->dien_thoai }}</span>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-envelope"></i>
                                    <span>{{ $thongTinChung->email }}</span>
                                </div>
                            </div>
                        @else
                            <p>Không có dữ liệu</p>
                        @endif
                    </div>
                </div>

                @foreach($duLieuChanTrang as $tenMuc => $danhSachMucCon)
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-widget">
                        <h4>{{ $tenMuc }}</h4>
                        <ul class="footer-links">
                            @forelse($danhSachMucCon as $item)
                                <li>
                                    @php
                                        // Xác định URL đúng: nếu bắt đầu bằng http hoặc https thì dùng luôn, nếu bắt đầu bằng / là nội bộ, còn lại là slug
                                        $duongDan = $item->duong_dan;
                                        if (Str::startsWith($duongDan, ['http://', 'https://'])) {
                                            $url = $duongDan;
                                        } elseif (Str::startsWith($duongDan, '/')) {
                                            $url = url($duongDan);
                                        } else {
                                            $url = route('footer.show', ['slug' => $duongDan]);
                                        }
                                    @endphp
                                   <a href="{{ $url }}"
                                   @if(Str::startsWith($url, ['http://', 'https://'])) target="_blank" rel="noopener noreferrer" @endif>
                                   <i class="{{ $item->icon ?? '' }}"></i> {{ $item->ten_muc_con }}
                                </a>
                                </li>
                            @empty
                                <li>Không có dữ liệu</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            @endforeach

            </div>
        </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="##" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  @yield('scripts')
  <script src="{{ asset('js/cart.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Vendor JS Files -->
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('js/aos.js') }}"></script>
  <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('js/glightbox.min.js') }}"></script>
  <script src="{{ asset('js/Drift.min.js') }}"></script>
  <script src="{{ asset('js/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script src="{{ asset('js/register.js') }}"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script defer="" src="./js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon="{&quot;rayId&quot;:&quot;9490ba9f9852409c&quot;,&quot;serverTiming&quot;:{&quot;name&quot;:{&quot;cfExtPri&quot;:true,&quot;cfEdge&quot;:true,&quot;cfOrigin&quot;:true,&quot;cfL4&quot;:true,&quot;cfSpeedBrain&quot;:true,&quot;cfCacheStatus&quot;:true}},&quot;version&quot;:&quot;2025.5.0&quot;,&quot;token&quot;:&quot;68c5ca450bae485a842ff76066d69420&quot;}" crossorigin="anonymous"></script>
@if (session('success'))
    <div id="bubble-alert" class="login-success">
        {!! session('success') !!}
    </div>
@endif
@if (session('success'))
<script>

    document.addEventListener('DOMContentLoaded', function () {
        const bubble = document.getElementById('bubble-alert');

        // Click để ẩn
        bubble.addEventListener('click', () => {
            bubble.style.opacity = '0';
            setTimeout(() => bubble.remove(), 500);
        });

        // Tự ẩn sau 3 giây
        setTimeout(() => {
            bubble.style.opacity = '0';
            setTimeout(() => bubble.remove(), 500);
        }, 3000);
    });
</script>

@endif
<script>
    $(document).ready(function() {
        console.log('jQuery loaded and document ready');

        $('#search-input').on('input', function() {
            let query = $(this).val().trim();
            console.log('Search query:', query);

            if (query.length > 0) {
                $.ajax({
                    url: '{{ url("/search-suggestions") }}',
                    method: 'GET',
                    data: { query: query },
                    dataType: 'json',
                    success: function(response) {
                        console.log('Suggestions received:', response);
                        let suggestions = $('#suggestions');
                        suggestions.empty();

                        if (Array.isArray(response) && response.length > 0) {
                            response.forEach(function(book) {
                                // Kiểm tra giá trị hợp lệ
                                let title = book.title || 'Không có tiêu đề';
                                let price = book.price ? parseInt(book.price).toLocaleString('vi-VN') + ' ₫' : 'N/A';
                                let image = book.image && book.image !== 'undefined' ? book.image : 'default.jpg';
                                let slug = book.slug || '';

                                let div = $('<div>')
                                    .addClass('suggestion-item')
                                    .html(`
                                        <img src="{{ url('image/book') }}/${image}" alt="${title}" onerror="this.src='{{ url('image/book/default.jpg') }}'">
                                        <span>${title}</span>
                                        <span class="price">${price}</span>
                                    `)
                                    .on('click', function() {
                                        if (slug) {
                                            // Chuyển hướng đến trang chi tiết sách
                                            window.location.href = '{{ url("/sp") }}/' + slug;
                                        } else {
                                            console.error('Slug not found for book:', title);
                                        }
                                    });
                                suggestions.append(div);
                            });
                            suggestions.show();
                        } else {
                            suggestions.hide();
                            console.log('No suggestions found');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', status, error, xhr.responseText);
                        $('#suggestions').hide();
                    }
                });
            } else {
                $('#suggestions').hide();
            }
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.input-group').length) {
                $('#suggestions').hide();
            }
        });
    });
    </script>
<style>
    .suggestions-list .suggestion-item {
    display: flex;
    align-items: center;
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #eee;
    min-height: 80px; /* Đảm bảo chiều cao đồng đều */
}

.suggestions-list .suggestion-item:hover {
    background: #f8f9fa;
}

.suggestions-list .suggestion-item .book-content {
    display: flex;
    align-items: center;
    flex: 1; /* Chiếm phần lớn không gian */
    min-width: 0; /* Ngăn tràn nội dung */
}

.suggestions-list .suggestion-item img {
    width: 50px;
    height: 70px;
    object-fit: cover;
    margin-right: 10%;
    flex-shrink: 0; /* Ngăn hình ảnh co lại */
}

.suggestions-list .suggestion-item .book-info {
    flex: 1;
    min-width: 0; /* Ngăn tràn nội dung */
    max-width: 70%; /* Giới hạn chiều rộng tối đa của tiêu đề */
}

.suggestions-list .suggestion-item .book-info .title {
    font-size: 14px;
    color: #333;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap; /* Ngăn tiêu đề xuống dòng */
    margin: 0;
    padding-right: 10%x; /* Tạo khoảng cách với cột giá */
}

.suggestions-list .suggestion-item .price {
    flex: 0 0 80px; /* Tăng kích thước cột giá để ổn định */
    text-align: right;
    color: #dc3545;
    padding-left: 10%; /* Khoảng cách với cột trái */
    margin: 0;
    white-space: nowrap; /* Ngăn giá xuống dòng */
}

/* Đảm bảo container không bị tràn */
.suggestions-list {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

@media (max-width: 600px) {
    .suggestions-list .suggestion-item {
        flex-direction: column;
        align-items: flex-start;
    }
    .suggestions-list .suggestion-item .price {
        text-align: left;
        padding-left: 0;
        margin-top: 5px;
        flex: 0 0 auto;
    }
    .suggestions-list .suggestion-item .book-info {
        max-width: 100%; /* Hủy giới hạn trên màn hình nhỏ */
    }
}
</style>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://unpkg.com/laravel-echo/dist/echo.iife.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stack('scripts')
</body></html>

<!DOCTYPE html>
<!-- saved from url=(0056)# -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', 'BookShop - Trang chủ')</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <meta name="robots" content="noindex, nofollow">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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

  <header id="header" class="header position-relative">

    <!-- Main Header -->
    <div class="main-header">
      <div class="container-fluid container-xl">
        <div class="d-flex py-3 align-items-center justify-content-between">

          <!-- Logo -->
          <a href="{{ url("/")}}" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.webp" alt=""> -->
            <h1 class="sitename">BookShop</h1>
          </a>

          <!-- Search -->
          <form class="search-form desktop-search-form" action="{{ url('/search') }}" method="GET">
            <div class="input-group">
              <input type="text" name="query" class="form-control" placeholder="Tìm kiếm sách">
              <button class="btn" type="submit">
                <i class="bi bi-search"></i>
              </button>
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
                          <a class="dropdown-item d-flex align-items-center" href="#">
                              <i class="bi bi-bag-check me-2"></i>
                              <span>Giỏ hàng</span>
                          </a>
                          <a class="dropdown-item d-flex align-items-center" href="#">
                              <i class="bi bi-heart me-2"></i>
                              <span>Yêu thích</span>
                          </a>
                          <a class="dropdown-item d-flex align-items-center" href="#">
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
                          <h6>Chào mừng đến <span class="sitename">BookShop</span></h6>
                      </div>
                      <div class="dropdown-footer">
                          <a href="{{ url('/login') }}" class="btn btn-primary w-100 mb-2">Đăng nhập</a>
                          <a href="{{ url('/register') }}" class="btn btn-outline-primary w-100">Đăng ký</a>
                      </div>
                  @endguest
              </div>


            </div>

            <!-- Wishlist -->
            <a href="#" class="header-action-btn d-none d-md-block">
              <i class="bi bi-heart"></i>
              <span class="badge">0</span>
            </a>

            <a href="{{ url('/cart') }}" class="header-action-btn">
                <i class="bi bi-cart3"></i>
                {{-- <span class="badge"></span> --}}
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
              <li><a href=" {{ url('/') }} " class="active">Trang chủ</a></li>
              {{-- <li><a href=" {{ url('/about') }} ">Giới thiệu</a></li> --}}
              <li><a href=" {{ url('/category') }} ">Danh mục</a></li>
              <li><a href=" {{ url('/cart') }} ">Giỏ hàng</a></li>
              <li><a href=" {{ url('/checkout') }} ">Thanh toán</a></li>

              <!-- Products Mega Menu 1 -->
              <li class="products-megamenu-1"><span>Danh mục sách</span> <i class="bi bi-chevron-down toggle-dropdown"></i>

                <!-- Products Mega Menu 1 Mobile View -->
                <ul class="mobile-megamenu">

                  <li><a href="##">Featured Products</a></li>
                  <li><a href="##">New Arrivals</a></li>
                  <li><a href="##">Sale Items</a></li>

                  <li class="dropdown"><a href="##"><span>Clothing</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="##">Men's Wear</a></li>
                      <li><a href="##">Women's Wear</a></li>
                      <li><a href="##">Kids Collection</a></li>
                      <li><a href="##">Sportswear</a></li>
                      <li><a href="##">Accessories</a></li>
                    </ul>
                  </li>

                  <li class="dropdown"><a href="##"><span>Electronics</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="##">Smartphones</a></li>
                      <li><a href="##">Laptops</a></li>
                      <li><a href="##">Audio Devices</a></li>
                      <li><a href="##">Smart Home</a></li>
                      <li><a href="##">Accessories</a></li>
                    </ul>
                  </li>

                  <li class="dropdown"><a href="##"><span>Home &amp; Living</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="##">Furniture</a></li>
                      <li><a href="##">Decor</a></li>
                      <li><a href="##">Kitchen</a></li>
                      <li><a href="##">Bedding</a></li>
                      <li><a href="##">Lighting</a></li>
                    </ul>
                  </li>

                  <li class="dropdown"><a href="##"><span>Beauty</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="##">Skincare</a></li>
                      <li><a href="##">Makeup</a></li>
                      <li><a href="##">Haircare</a></li>
                      <li><a href="##">Fragrances</a></li>
                      <li><a href="##">Personal Care</a></li>
                    </ul>
                  </li>

                </ul><!-- End Products Mega Menu 1 Mobile View -->

                <!-- Products Mega Menu 1 Desktop View -->
                <div class="desktop-megamenu">

                  <div class="megamenu-tabs">
                    <ul class="nav nav-tabs" id="productMegaMenuTabs" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="featured-tab" data-bs-toggle="tab" data-bs-target="#featured-content-1862" type="button" aria-selected="true" role="tab">Sách bán chạy</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="new-tab" data-bs-toggle="tab" data-bs-target="#new-content-1862" type="button" aria-selected="false" tabindex="-1" role="tab">Sách mới</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="sale-tab" data-bs-toggle="tab" data-bs-target="#sale-content-1862" type="button" aria-selected="false" tabindex="-1" role="tab">Sách giảm giá</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="category-tab" data-bs-toggle="tab" data-bs-target="#category-content-1862" type="button" aria-selected="false" tabindex="-1" role="tab">Danh mục sách</button>
                      </li>
                    </ul>
                  </div>

                  <!-- Tabs Content -->
                  <div class="megamenu-content tab-content">

                    <!-- Featured Tab -->
                    <div class="tab-pane fade show active" id="featured-content-1862" role="tabpanel" aria-labelledby="featured-tab">
                      <div class="product-grid">
                        <div class="product-card">
                          <div class="product-image">
                            <img src="./image/product-1.webp" alt="Featured Product" loading="lazy">
                          </div>
                          <div class="product-info">
                            <h5>Premium Headphones</h5>
                            <p class="price">$129.99</p>
                            <a href="##" class="btn-view">View Product</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- New Arrivals Tab -->
                    <div class="tab-pane fade" id="new-content-1862" role="tabpanel" aria-labelledby="new-tab">
                      <div class="product-grid">
                        <div class="product-card">
                          <div class="product-image">
                            <img src="./image/product-5.webp" alt="New Arrival" loading="lazy">
                            <span class="badge-new">New</span>
                          </div>
                          <div class="product-info">
                            <h5>Fitness Tracker</h5>
                            <p class="price">$69.99</p>
                            <a href="##" class="btn-view">View Product</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Sale Tab -->
                    <div class="tab-pane fade" id="sale-content-1862" role="tabpanel" aria-labelledby="sale-tab">
                      <div class="product-grid">
                        <div class="product-card">
                          <div class="product-image">
                            <img src="./image/product-9.webp" alt="Sale Product" loading="lazy">
                            <span class="badge-sale">-30%</span>
                          </div>
                          <div class="product-info">
                            <h5>Wireless Keyboard</h5>
                            <p class="price"><span class="original-price">$89.99</span> $62.99</p>
                            <a href="##" class="btn-view">View Product</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Categories Tab -->
                    <div class="tab-pane fade" id="category-content-1862" role="tabpanel" aria-labelledby="category-tab">
                      <div class="category-grid">
                        <div class="category-column">
                          <h4>Clothing</h4>
                          <ul>
                            <li><a href="##">Men's Wear</a></li>
                            <li><a href="##">Women's Wear</a></li>
                            <li><a href="##">Kids Collection</a></li>
                            <li><a href="##">Sportswear</a></li>
                            <li><a href="##">Accessories</a></li>
                          </ul>
                        </div>
                        <div class="category-column">
                          <h4>Electronics</h4>
                          <ul>
                            <li><a href="##">Smartphones</a></li>
                            <li><a href="##">Laptops</a></li>
                            <li><a href="##">Audio Devices</a></li>
                            <li><a href="##">Smart Home</a></li>
                            <li><a href="##">Accessories</a></li>
                          </ul>
                        </div>
                        <div class="category-column">
                          <h4>Home &amp; Living</h4>
                          <ul>
                            <li><a href="##">Furniture</a></li>
                            <li><a href="##">Decor</a></li>
                            <li><a href="##">Kitchen</a></li>
                            <li><a href="##">Bedding</a></li>
                            <li><a href="##">Lighting</a></li>
                          </ul>
                        </div>
                        <div class="category-column">
                          <h4>Beauty</h4>
                          <ul>
                            <li><a href="##">Skincare</a></li>
                            <li><a href="##">Makeup</a></li>
                            <li><a href="##">Haircare</a></li>
                            <li><a href="##">Fragrances</a></li>
                            <li><a href="##">Personal Care</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>

                  </div>

                </div><!-- End Products Mega Menu 1 Desktop View -->

              </li><!-- End Products Mega Menu 1 -->
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

              <li><a href=" {{ url('/contact') }} ">Liên hệ</a></li>

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
    <div class="footer-newsletter">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2>Tham Gia Bản Tin Của Chúng Tôi</h2>
                    <p>Đăng ký để nhận ưu đãi đặc biệt, quà tặng miễn phí và những chương trình khuyến mãi hiếm có.</p>
                    <form action="#" method="post" class="php-email-form">
                        <div class="newsletter-form d-flex">
                            <input type="email" name="email" placeholder="Địa chỉ email của bạn" required="">
                            <button type="submit">Đăng ký</button>
                        </div>
                        <div class="loading">Đang xử lý...</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Yêu cầu đăng ký của bạn đã được gửi. Cảm ơn bạn!</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-main">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-widget footer-about">
                        <a href=" #" class="logo">
                            @if(isset($thongTinChung) && $thongTinChung->logo_url)
                            <img src="{{ asset($thongTinChung->logo_url) }}" alt="{{ $thongTinChung->ten_cong_ty ?? 'Logo' }}" class="sitename">
                        @else
                            <span class="sitename">DEMO</span>
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

                <!-- Shop (Dịch Vụ) -->
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-widget">
                        <h4>Dịch Vụ</h4>
                        <ul class="footer-links">
                            @if(isset($duLieuChanTrang['Dịch Vụ']))
                                @foreach($duLieuChanTrang['Dịch Vụ'] as $item)
                                    <li><a href="{{ $item->duong_dan ?? '#' }}">{{ $item->noi_dung }}</a></li>
                                @endforeach
                            @else
                                <li>Không có dữ liệu</li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Support (Hỗ Trợ) -->
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-widget">
                        <h4>Hỗ Trợ</h4>
                        <ul class="footer-links">
                            @if(isset($duLieuChanTrang['Hỗ Trợ']))
                                @foreach($duLieuChanTrang['Hỗ Trợ'] as $item)
                                    <li><a href="{{ $item->duong_dan ?? '#' }}">{{ $item->noi_dung }}</a></li>
                                @endforeach
                            @else
                                <li>Không có dữ liệu</li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Company (Tài Khoản Của Tôi) -->
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-widget">
                        <h4>Tài khoản của tôi</h4>
                        <ul class="footer-links">
                            @if(isset($duLieuChanTrang['Tài Khoản Của Tôi']))
                                @foreach($duLieuChanTrang['Tài Khoản Của Tôi'] as $item)
                                    <li><a href="{{ $item->duong_dan ?? '#' }}">{{ $item->noi_dung }}</a></li>
                                @endforeach
                            @else
                                <li>Không có dữ liệu</li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Download App + Social Links -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget">
                            <h5>Theo dõi tại</h5>
                            <div class="social-icons">
                                <a href=" #" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                                <a href=" #" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                                <a href=" #" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                                <a href=" #" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                                <a href=" #" aria-label="Pinterest"><i class="bi bi-pinterest"></i></a>
                                <a href=" #" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
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
  <script src="{{ asset('js/main.js') }}"></script>register
  <script src="{{ asset('js/register.js') }}"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


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


</body></html>

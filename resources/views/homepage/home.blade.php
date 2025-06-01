@extends('layout.main')

@section('title', 'eStore - Home')
@section('content')
  <main class="main">

    <!-- Hero Section -->
    <section class="ecommerce-hero-1 hero section" id="hero">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 content-col aos-init aos-animate" data-aos="fade-right" data-aos-delay="100">
            <div class="content">
              <span class="promo-badge">New Collection 2025</span>
              <h1>Discover Stylish <span>Fashion</span> For Every Season</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Vestibulum ante ipsum primis in faucibus.</p>
              <div class="hero-cta">
                <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="btn btn-shop">Shop Now <i class="bi bi-arrow-right"></i></a>
                <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="btn btn-collection">View Collection</a>
              </div>
              <div class="hero-features">
                <div class="feature-item">
                  <i class="bi bi-truck"></i>
                  <span>Free Shipping</span>
                </div>
                <div class="feature-item">
                  <i class="bi bi-shield-check"></i>
                  <span>Secure Payment</span>
                </div>
                <div class="feature-item">
                  <i class="bi bi-arrow-repeat"></i>
                  <span>Easy Returns</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 image-col aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">
            <div class="hero-image">
              <img src="./image/product-f-9.webp" alt="Fashion Product" class="main-product" loading="lazy">
              <div class="floating-product product-1 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                <img src="./image/product-4.webp" alt="Product 2">
                <div class="product-info">
                  <h4>Summer Collection</h4>
                  <span class="price">$89.99</span>
                </div>
              </div>
              <div class="floating-product product-2 aos-init" data-aos="fade-up" data-aos-delay="400">
                <img src="./image/product-3.webp" alt="Product 3">
                <div class="product-info">
                  <h4>Casual Wear</h4>
                  <span class="price">$59.99</span>
                </div>
              </div>
              <div class="discount-badge aos-init aos-animate" data-aos="zoom-in" data-aos-delay="500">
                <span class="percent">30%</span>
                <span class="text">OFF</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->

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
              <h3>Free Shipping</h3>
              <p>Nulla sit morbi vestibulum eros duis amet, consectetur vitae lacus. Ut quis tempor felis sed nunc viverra.</p>
            </div>
          </div><!-- End Info Card 1 -->

          <!-- Info Card 2 -->
          <div class="col-12 col-sm-6 col-lg-3 aos-init" data-aos="fade-up" data-aos-delay="300">
            <div class="info-card text-center">
              <div class="icon-box">
                <i class="bi bi-piggy-bank"></i>
              </div>
              <h3>Money Back Guarantee</h3>
              <p>Nullam gravida felis ac nunc tincidunt, sed malesuada justo pulvinar. Vestibulum nec diam vitae eros.</p>
            </div>
          </div><!-- End Info Card 2 -->

          <!-- Info Card 3 -->
          <div class="col-12 col-sm-6 col-lg-3 aos-init" data-aos="fade-up" data-aos-delay="400">
            <div class="info-card text-center">
              <div class="icon-box">
                <i class="bi bi-percent"></i>
              </div>
              <h3>Discount Offers</h3>
              <p>Nulla ipsum nisi vel adipiscing amet, dignissim consectetur ornare. Vestibulum quis posuere elit auctor.</p>
            </div>
          </div><!-- End Info Card 3 -->

          <!-- Info Card 4 -->
          <div class="col-12 col-sm-6 col-lg-3 aos-init" data-aos="fade-up" data-aos-delay="500">
            <div class="info-card text-center">
              <div class="icon-box">
                <i class="bi bi-headset"></i>
              </div>
              <h3>24/7 Support</h3>
              <p>Ipsum dolor amet sit consectetur adipiscing, nullam vitae euismod tempor nunc felis vestibulum ornare.</p>
            </div>
          </div><!-- End Info Card 4 -->
        </div>

      </div>

    </section><!-- /Info Cards Section -->

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

          <div class="swiper-wrapper" id="swiper-wrapper-53e34c62701b4e56" aria-live="off" style="cursor: grab; transition-duration: 0ms; transform: translate3d(-438.667px, 0px, 0px); transition-delay: 0ms;">
            <!-- Category Card 1 -->
            <div class="swiper-slide" style="width: 199.333px; margin-right: 20px;" role="group" aria-label="1 / 8" data-swiper-slide-index="0">
              <div class="category-card aos-init" data-aos="fade-up" data-aos-delay="100">
                <div class="category-image">
                  <img src="./image/product-1.webp" alt="Category" class="img-fluid">
                </div>
                <h3 class="category-title">Vestibulum ante</h3>
                <p class="category-count">4 Products</p>
                <a href="https://bootstrapmade.com/content/demo/eStore/ctaegory.html" class="stretched-link"></a>
              </div>
            </div>

            <!-- Category Card 2 -->
            <div class="swiper-slide swiper-slide-prev" style="width: 199.333px; margin-right: 20px;" role="group" aria-label="2 / 8" data-swiper-slide-index="1">
              <div class="category-card aos-init" data-aos="fade-up" data-aos-delay="200">
                <div class="category-image">
                  <img src="./image/product-6.webp" alt="Category" class="img-fluid">
                </div>
                <h3 class="category-title">Maecenas nec</h3>
                <p class="category-count">8 Products</p>
                <a href="https://bootstrapmade.com/content/demo/eStore/ctaegory.html" class="stretched-link"></a>
              </div>
            </div>

            <!-- Category Card 3 -->
            <div class="swiper-slide swiper-slide-active" style="width: 199.333px; margin-right: 20px;" role="group" aria-label="3 / 8" data-swiper-slide-index="2">
              <div class="category-card aos-init" data-aos="fade-up" data-aos-delay="300">
                <div class="category-image">
                  <img src="./image/product-9.webp" alt="Category" class="img-fluid">
                </div>
                <h3 class="category-title">Aenean tellus</h3>
                <p class="category-count">4 Products</p>
                <a href="https://bootstrapmade.com/content/demo/eStore/ctaegory.html" class="stretched-link"></a>
              </div>
            </div>

            <!-- Category Card 4 -->
            <div class="swiper-slide swiper-slide-next" style="width: 199.333px; margin-right: 20px;" role="group" aria-label="4 / 8" data-swiper-slide-index="3">
              <div class="category-card aos-init" data-aos="fade-up" data-aos-delay="400">
                <div class="category-image">
                  <img src="./image/product-f-1.webp" alt="Category" class="img-fluid">
                </div>
                <h3 class="category-title">Donec quam</h3>
                <p class="category-count">12 Products</p>
                <a href="https://bootstrapmade.com/content/demo/eStore/ctaegory.html" class="stretched-link"></a>
              </div>
            </div>

            <!-- Category Card 5 -->
            <div class="swiper-slide" style="width: 199.333px; margin-right: 20px;" role="group" aria-label="5 / 8" data-swiper-slide-index="4">
              <div class="category-card aos-init" data-aos="fade-up" data-aos-delay="500">
                <div class="category-image">
                  <img src="./image/product-10.webp" alt="Category" class="img-fluid">
                </div>
                <h3 class="category-title">Phasellus leo</h3>
                <p class="category-count">4 Products</p>
                <a href="https://bootstrapmade.com/content/demo/eStore/ctaegory.html" class="stretched-link"></a>
              </div>
            </div>

            <!-- Category Card 6 -->
            <div class="swiper-slide" style="width: 199.333px; margin-right: 20px;" role="group" aria-label="6 / 8" data-swiper-slide-index="5">
              <div class="category-card aos-init" data-aos="fade-up" data-aos-delay="600">
                <div class="category-image">
                  <img src="./image/product-m-1.webp" alt="Category" class="img-fluid">
                </div>
                <h3 class="category-title">Quisque rutrum</h3>
                <p class="category-count">2 Products</p>
                <a href="https://bootstrapmade.com/content/demo/eStore/ctaegory.html" class="stretched-link"></a>
              </div>
            </div>

            <!-- Category Card 7 -->
            <div class="swiper-slide" style="width: 199.333px; margin-right: 20px;" role="group" aria-label="7 / 8" data-swiper-slide-index="6">
              <div class="category-card aos-init" data-aos="fade-up" data-aos-delay="700">
                <div class="category-image">
                  <img src="./image/product-10.webp" alt="Category" class="img-fluid">
                </div>
                <h3 class="category-title">Etiam ultricies</h3>
                <p class="category-count">4 Products</p>
                <a href="https://bootstrapmade.com/content/demo/eStore/ctaegory.html" class="stretched-link"></a>
              </div>
            </div>

            <!-- Category Card 8 -->
            <div class="swiper-slide" role="group" aria-label="8 / 8" data-swiper-slide-index="7" style="width: 199.333px; margin-right: 20px;">
              <div class="category-card aos-init" data-aos="fade-up" data-aos-delay="800">
                <div class="category-image">
                  <img src="./image/product-2.webp" alt="Category" class="img-fluid">
                </div>
                <h3 class="category-title">Fusce fermentum</h3>
                <p class="category-count">4 Products</p>
                <a href="https://bootstrapmade.com/content/demo/eStore/ctaegory.html" class="stretched-link"></a>
              </div>
            </div>
          </div>

          <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-53e34c62701b4e56"></div>
          <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-53e34c62701b4e56"></div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>

      </div>

    </section><!-- /Category Cards Section -->

    <!-- Best Sellers Section -->
    <section id="best-sellers" class="best-sellers section">

      <!-- Section Title -->
      <div class="container section-title aos-init" data-aos="fade-up">
        <h2>Best Sellers</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container aos-init" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <!-- Product 1 -->
          <div class="col-md-6 col-lg-3 aos-init" data-aos="fade-up" data-aos-delay="100">
            <div class="product-card">
              <div class="product-image">
                <img src="./image/product-1.webp" class="img-fluid default-image" alt="Product" loading="lazy">
                <img src="./image/product-1-variant.webp" class="img-fluid hover-image" alt="Product hover" loading="lazy">
                <div class="product-tags">
                  <span class="badge bg-accent">New</span>
                </div>
                <div class="product-actions">
                  <button class="btn-wishlist" type="button" aria-label="Add to wishlist">
                    <i class="bi bi-heart"></i>
                  </button>
                  <button class="btn-quickview" type="button" aria-label="Quick view">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>
              <div class="product-info">
                <h3 class="product-title"><a href="https://bootstrapmade.com/content/demo/eStore/product-details.html">Lorem ipsum dolor sit amet</a></h3>
                <div class="product-price">
                  <span class="current-price">$89.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                  <span class="rating-count">(42)</span>
                </div>
                <button class="btn btn-add-to-cart">
                  <i class="bi bi-bag-plus me-2"></i>Add to Cart
                </button>
              </div>
            </div>
          </div><!-- End Product 1 -->

          <!-- Product 2 -->
          <div class="col-md-6 col-lg-3 aos-init" data-aos="fade-up" data-aos-delay="150">
            <div class="product-card">
              <div class="product-image">
                <img src="./image/product-4.webp" class="img-fluid default-image" alt="Product" loading="lazy">
                <img src="./image/product-4-variant.webp" class="img-fluid hover-image" alt="Product hover" loading="lazy">
                <div class="product-tags">
                  <span class="badge bg-sale">Sale</span>
                </div>
                <div class="product-actions">
                  <button class="btn-wishlist" type="button" aria-label="Add to wishlist">
                    <i class="bi bi-heart"></i>
                  </button>
                  <button class="btn-quickview" type="button" aria-label="Quick view">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>
              <div class="product-info">
                <h3 class="product-title"><a href="https://bootstrapmade.com/content/demo/eStore/product-details.html">Consectetur adipiscing elit</a></h3>
                <div class="product-price">
                  <span class="current-price">$64.99</span>
                  <span class="original-price">$79.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <span class="rating-count">(28)</span>
                </div>
                <button class="btn btn-add-to-cart">
                  <i class="bi bi-bag-plus me-2"></i>Add to Cart
                </button>
              </div>
            </div>
          </div><!-- End Product 2 -->

          <!-- Product 3 -->
          <div class="col-md-6 col-lg-3 aos-init" data-aos="fade-up" data-aos-delay="200">
            <div class="product-card">
              <div class="product-image">
                <img src="./image/product-7.webp" class="img-fluid default-image" alt="Product" loading="lazy">
                <img src="./image/product-7-variant.webp" class="img-fluid hover-image" alt="Product hover" loading="lazy">
                <div class="product-actions">
                  <button class="btn-wishlist" type="button" aria-label="Add to wishlist">
                    <i class="bi bi-heart"></i>
                  </button>
                  <button class="btn-quickview" type="button" aria-label="Quick view">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>
              <div class="product-info">
                <h3 class="product-title"><a href="https://bootstrapmade.com/content/demo/eStore/product-details.html">Sed do eiusmod tempor incididunt</a></h3>
                <div class="product-price">
                  <span class="current-price">$119.00</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <span class="rating-count">(56)</span>
                </div>
                <button class="btn btn-add-to-cart">
                  <i class="bi bi-bag-plus me-2"></i>Add to Cart
                </button>
              </div>
            </div>
          </div><!-- End Product 3 -->

          <!-- Product 4 -->
          <div class="col-md-6 col-lg-3 aos-init" data-aos="fade-up" data-aos-delay="250">
            <div class="product-card">
              <div class="product-image">
                <img src="./image/product-12.webp" class="img-fluid default-image" alt="Product" loading="lazy">
                <img src="./image/product-12-variant.webp" class="img-fluid hover-image" alt="Product hover" loading="lazy">
                <div class="product-tags">
                  <span class="badge bg-sold-out">Sold Out</span>
                </div>
                <div class="product-actions">
                  <button class="btn-wishlist" type="button" aria-label="Add to wishlist">
                    <i class="bi bi-heart"></i>
                  </button>
                  <button class="btn-quickview" type="button" aria-label="Quick view">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>
              <div class="product-info">
                <h3 class="product-title"><a href="https://bootstrapmade.com/content/demo/eStore/product-details.html">Ut labore et dolore magna aliqua</a></h3>
                <div class="product-price">
                  <span class="current-price">$75.50</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <i class="bi bi-star"></i>
                  <span class="rating-count">(15)</span>
                </div>
                <button class="btn btn-add-to-cart btn-disabled" disabled="">
                  <i class="bi bi-bag-plus me-2"></i>Sold Out
                </button>
              </div>
            </div>
          </div><!-- End Product 4 -->
        </div>

      </div>

    </section><!-- /Best Sellers Section -->

    <!-- Product List Section -->
    <section id="product-list" class="product-list section">

      <div class="container isotope-layout aos-init" data-aos="fade-up" data-aos-delay="100" data-default-filter="*" data-layout="masonry" data-sort="original-order">

        <div class="row">
          <div class="col-12">
            <div class="product-filters isotope-filters mb-5 d-flex justify-content-center aos-init" data-aos="fade-up">
              <ul class="d-flex flex-wrap gap-2 list-unstyled">
                <li class="filter-active" data-filter="*">All</li>
                <li data-filter=".filter-clothing">Clothing</li>
                <li data-filter=".filter-accessories">Accessories</li>
                <li data-filter=".filter-electronics">Electronics</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="row product-container isotope-container aos-init" data-aos="fade-up" data-aos-delay="200" style="position: relative; height: 926.42px;">

          <!-- Product Item 1 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing" style="position: absolute; left: 0px; top: 0px;">
            <div class="product-card">
              <div class="product-image">
                <span class="badge">Sale</span>
                <img src="./image/product-11.webp" alt="Product" class="img-fluid main-img">
                <img src="./image/product-11-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="https://bootstrapmade.com/content/demo/eStore/cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="https://bootstrapmade.com/content/demo/eStore/product-details.html">Lorem ipsum dolor sit amet</a></h5>
                <div class="product-price">
                  <span class="current-price">$89.99</span>
                  <span class="old-price">$129.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                  <span>(24)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

          <!-- Product Item 2 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-electronics" style="position: absolute; left: 330px; top: 0px;">
            <div class="product-card">
              <div class="product-image">
                <img src="./image/product-9.webp" alt="Product" class="img-fluid main-img">
                <img src="./image/product-9-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="https://bootstrapmade.com/content/demo/eStore/cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="https://bootstrapmade.com/content/demo/eStore/product-details.html">Consectetur adipiscing elit</a></h5>
                <div class="product-price">
                  <span class="current-price">$249.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <span>(18)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

          <!-- Product Item 3 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-accessories" style="position: absolute; left: 660px; top: 0px;">
            <div class="product-card">
              <div class="product-image">
                <span class="badge">New</span>
                <img src="./image/product-3.webp" alt="Product" class="img-fluid main-img">
                <img src="./image/product-3-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="https://bootstrapmade.com/content/demo/eStore/cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="https://bootstrapmade.com/content/demo/eStore/product-details.html">Sed do eiusmod tempor</a></h5>
                <div class="product-price">
                  <span class="current-price">$59.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <i class="bi bi-star"></i>
                  <span>(7)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

          <!-- Product Item 4 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing" style="position: absolute; left: 990px; top: 0px;">
            <div class="product-card">
              <div class="product-image">
                <img src="./image/product-4.webp" alt="Product" class="img-fluid main-img">
                <img src="./image/product-4-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="https://bootstrapmade.com/content/demo/eStore/cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="https://bootstrapmade.com/content/demo/eStore/product-details.html">Incididunt ut labore et dolore</a></h5>
                <div class="product-price">
                  <span class="current-price">$79.99</span>
                  <span class="old-price">$99.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <span>(32)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

          <!-- Product Item 5 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-electronics" style="position: absolute; left: 0px; top: 463.21px;">
            <div class="product-card">
              <div class="product-image">
                <span class="badge">Sale</span>
                <img src="./image/product-5.webp" alt="Product" class="img-fluid main-img">
                <img src="./image/product-5-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="https://bootstrapmade.com/content/demo/eStore/cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="https://bootstrapmade.com/content/demo/eStore/product-details.html">Magna aliqua ut enim ad minim</a></h5>
                <div class="product-price">
                  <span class="current-price">$199.99</span>
                  <span class="old-price">$249.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                  <i class="bi bi-star"></i>
                  <span>(15)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

          <!-- Product Item 6 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-accessories" style="position: absolute; left: 330px; top: 463.21px;">
            <div class="product-card">
              <div class="product-image">
                <img src="./image/product-6.webp" alt="Product" class="img-fluid main-img">
                <img src="./image/product-6-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="https://bootstrapmade.com/content/demo/eStore/cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="https://bootstrapmade.com/content/demo/eStore/product-details.html">Veniam quis nostrud exercitation</a></h5>
                <div class="product-price">
                  <span class="current-price">$45.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <span>(21)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

          <!-- Product Item 7 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing" style="position: absolute; left: 660px; top: 463.21px;">
            <div class="product-card">
              <div class="product-image">
                <span class="badge">New</span>
                <img src="./image/product-7.webp" alt="Product" class="img-fluid main-img">
                <img src="./image/product-7-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="https://bootstrapmade.com/content/demo/eStore/cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="https://bootstrapmade.com/content/demo/eStore/product-details.html">Ullamco laboris nisi ut aliquip</a></h5>
                <div class="product-price">
                  <span class="current-price">$69.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                  <i class="bi bi-star"></i>
                  <span>(11)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

          <!-- Product Item 8 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-electronics" style="position: absolute; left: 990px; top: 463.21px;">
            <div class="product-card">
              <div class="product-image">
                <img src="./image/product-8.webp" alt="Product" class="img-fluid main-img">
                <img src="./image/product-8-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="https://bootstrapmade.com/content/demo/eStore/cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="https://bootstrapmade.com/content/demo/eStore/product-details.html">Ex ea commodo consequat</a></h5>
                <div class="product-price">
                  <span class="current-price">$159.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <span>(29)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

        </div>

        <div class="text-center mt-5 aos-init" data-aos="fade-up">
          <a href="https://bootstrapmade.com/content/demo/eStore/index.html#" class="view-all-btn">View All Products <i class="bi bi-arrow-right"></i></a>
        </div>

      </div>

    </section><!-- /Product List Section -->

  </main>
@endsection
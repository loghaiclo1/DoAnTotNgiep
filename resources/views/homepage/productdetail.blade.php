
@extends('layout.main')

@section('title', 'BookShop - Chi Tiết Sản Phẩm')
@section('content')
    <main class="main">

        <div class="page-title light-background">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Thông tin sản phẩm</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ url('/') }}">Trang chủ</a></li>
                        <li><a href="{{ url('/danh-muc/' . $book->category->slug) }}">{{ $book->category->name }}</a></li>
                        <li class="current">{{ $book->TenSach }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Product Details Section -->
        <section id="product-details" class="product-details section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <!-- Product Images -->
                    <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
                        <div class="product-images">
                            <div class="main-image-container mb-3">
                                <div style="display: flex; justify-content: center;">
                                    <img src="{{ asset('image/book/' . $book->HinhAnh) }}" alt="{{ $book->TenSach }}"
                                        class="img-fluid main-image" id="main-product-image" style="height: 500px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                        <div class="product-info">
                            <div class="product-meta mb-2">
                                <span class="product-category">{{ $book->category->name ?? 'Chưa có danh mục' }}</span>
                            </div>

                            <h1 class="product-title">{{ $book->TenSach }}</h1>

                            <div class="product-price-container mb-4">
                                <span class="current-price">{{ number_format($book->GiaBan, 0, ',', '.') }}₫</span>
                                @if ($book->GiaCu)
                                    <span class="original-price">{{ number_format($book->GiaCu, 0, ',', '.') }}₫</span>
                                    <span
                                        class="discount-badge">-{{ round(100 - ($book->GiaBan / $book->GiaCu) * 100) }}%</span>
                                @endif
                            </div>

                            <div class="product-availability mb-4">
                                @if ($book->SoLuong > 0)
                                    <i class="bi bi-check-circle-fill text-success"></i> <span>Còn hàng</span>
                                @else
                                    <i class="bi bi-x-circle-fill text-danger"></i> <span>Hết hàng</span>
                                @endif
                            </div>

                            <!-- Quantity -->
                            <div class="product-quantity mb-4">
                                <h6 class="option-title">Số lượng:</h6>
                                <div class="quantity-selector">
                                    <button class="quantity-btn decrease"><i class="bi bi-dash"></i></button>
                                    <input type="number" class="quantity-input" value="1" min="1"
                                        max="{{ $book->SoLuong }}" name="quantity">
                                    <button class="quantity-btn increase"><i class="bi bi-plus"></i></button>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="product-actions">
                                <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->MaSach }}">
                                    <button type="submit" class="btn btn-primary add-to-cart-btn"
                                        {{ $book->SoLuong == 0 ? 'disabled' : '' }}>
                                        <i class="bi bi-cart-plus"></i> Thêm vào giỏ
                                    </button>
                                </form>
                                <button class="btn btn-outline-secondary wishlist-btn">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Details Tabs -->
                <div class="row mt-5" data-aos="fade-up">
                    <div class="col-12">
                        <div class="product-details-tabs">
                            <ul class="nav nav-tabs" id="productTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab"
                                        aria-controls="description" aria-selected="true">Description</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="specifications-tab" data-bs-toggle="tab"
                                        data-bs-target="#specifications" type="button" role="tab"
                                        aria-controls="specifications" aria-selected="false">Specifications</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                                        type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews
                                        (42)</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="productTabsContent">
                                <!-- Description Tab -->
                                <div class="tab-pane fade show active" id="description" role="tabpanel"
                                    aria-labelledby="description-tab">
                                    <div class="product-description">
                                        <h4>Product Overview</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at lacus
                                            congue, suscipit elit nec, tincidunt orci. Phasellus egestas nisi vitae lectus
                                            imperdiet venenatis. Suspendisse vulputate quam diam, et consectetur augue
                                            condimentum in. Aenean dapibus urna eget nisi pharetra, in iaculis nulla
                                            blandit. Praesent at consectetur sem, sed sollicitudin nibh. Ut interdum risus
                                            ac nulla placerat aliquet.</p>

                                        <h4>Key Features</h4>
                                        <ul>
                                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit</li>
                                            <li>Vestibulum at lacus congue, suscipit elit nec, tincidunt orci</li>
                                            <li>Phasellus egestas nisi vitae lectus imperdiet venenatis</li>
                                            <li>Suspendisse vulputate quam diam, et consectetur augue condimentum in</li>
                                            <li>Aenean dapibus urna eget nisi pharetra, in iaculis nulla blandit</li>
                                        </ul>

                                        <h4>What's in the Box</h4>
                                        <ul>
                                            <li>Lorem Ipsum Wireless Headphones</li>
                                            <li>Carrying Case</li>
                                            <li>USB-C Charging Cable</li>
                                            <li>3.5mm Audio Cable</li>
                                            <li>User Manual</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Specifications Tab -->
                                <div class="tab-pane fade" id="specifications" role="tabpanel"
                                    aria-labelledby="specifications-tab">
                                    <div class="product-specifications">
                                        <div class="specs-group">
                                            <h4>Technical Specifications</h4>
                                            <div class="specs-table">
                                                <div class="specs-row">
                                                    <div class="specs-label">Connectivity</div>
                                                    <div class="specs-value">Bluetooth 5.0, 3.5mm jack</div>
                                                </div>
                                                <div class="specs-row">
                                                    <div class="specs-label">Battery Life</div>
                                                    <div class="specs-value">Up to 30 hours</div>
                                                </div>
                                                <div class="specs-row">
                                                    <div class="specs-label">Charging Time</div>
                                                    <div class="specs-value">3 hours</div>
                                                </div>
                                                <div class="specs-row">
                                                    <div class="specs-label">Driver Size</div>
                                                    <div class="specs-value">40mm</div>
                                                </div>
                                                <div class="specs-row">
                                                    <div class="specs-label">Frequency Response</div>
                                                    <div class="specs-value">20Hz - 20kHz</div>
                                                </div>
                                                <div class="specs-row">
                                                    <div class="specs-label">Impedance</div>
                                                    <div class="specs-value">32 Ohm</div>
                                                </div>
                                                <div class="specs-row">
                                                    <div class="specs-label">Weight</div>
                                                    <div class="specs-value">250g</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="specs-group">
                                            <h4>Features</h4>
                                            <div class="specs-table">
                                                <div class="specs-row">
                                                    <div class="specs-label">Noise Cancellation</div>
                                                    <div class="specs-value">Active Noise Cancellation (ANC)</div>
                                                </div>
                                                <div class="specs-row">
                                                    <div class="specs-label">Controls</div>
                                                    <div class="specs-value">Touch controls, Voice assistant</div>
                                                </div>
                                                <div class="specs-row">
                                                    <div class="specs-label">Microphone</div>
                                                    <div class="specs-value">Dual beamforming microphones</div>
                                                </div>
                                                <div class="specs-row">
                                                    <div class="specs-label">Water Resistance</div>
                                                    <div class="specs-value">IPX4 (splash resistant)</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reviews Tab -->
                                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                    <div class="product-reviews">
                                        <div class="reviews-summary">
                                            <div class="overall-rating">
                                                <div class="rating-number">4.5</div>
                                                <div class="rating-stars">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-half"></i>
                                                </div>
                                                <div class="rating-count">Based on 42 reviews</div>
                                            </div>

                                            <div class="rating-breakdown">
                                                <div class="rating-bar">
                                                    <div class="rating-label">5 stars</div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 65%;"
                                                            aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="rating-count">27</div>
                                                </div>
                                                <div class="rating-bar">
                                                    <div class="rating-label">4 stars</div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="rating-count">10</div>
                                                </div>
                                                <div class="rating-bar">
                                                    <div class="rating-label">3 stars</div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 8%;"
                                                            aria-valuenow="8" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="rating-count">3</div>
                                                </div>
                                                <div class="rating-bar">
                                                    <div class="rating-label">2 stars</div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 2%;"
                                                            aria-valuenow="2" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="rating-count">1</div>
                                                </div>
                                                <div class="rating-bar">
                                                    <div class="rating-label">1 star</div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 2%;"
                                                            aria-valuenow="2" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="rating-count">1</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="review-form-container">
                                            <h4>Write a Review</h4>
                                            <form class="review-form">
                                                <div class="rating-select mb-4">
                                                    <label class="form-label">Your Rating</label>
                                                    <div class="star-rating">
                                                        <input type="radio" id="star5" name="rating"
                                                            value="5"><label for="star5" title="5 stars"><i
                                                                class="bi bi-star-fill"></i></label>
                                                        <input type="radio" id="star4" name="rating"
                                                            value="4"><label for="star4" title="4 stars"><i
                                                                class="bi bi-star-fill"></i></label>
                                                        <input type="radio" id="star3" name="rating"
                                                            value="3"><label for="star3" title="3 stars"><i
                                                                class="bi bi-star-fill"></i></label>
                                                        <input type="radio" id="star2" name="rating"
                                                            value="2"><label for="star2" title="2 stars"><i
                                                                class="bi bi-star-fill"></i></label>
                                                        <input type="radio" id="star1" name="rating"
                                                            value="1"><label for="star1" title="1 star"><i
                                                                class="bi bi-star-fill"></i></label>
                                                    </div>
                                                </div>

                                                <div class="row g-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label for="review-name" class="form-label">Your Name</label>
                                                        <input type="text" class="form-control" id="review-name"
                                                            required="">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="review-email" class="form-label">Your Email</label>
                                                        <input type="email" class="form-control" id="review-email"
                                                            required="">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="review-title" class="form-label">Review Title</label>
                                                    <input type="text" class="form-control" id="review-title"
                                                        required="">
                                                </div>

                                                <div class="mb-4">
                                                    <label for="review-content" class="form-label">Your Review</label>
                                                    <textarea class="form-control" id="review-content" rows="4" required=""></textarea>
                                                    <div class="form-text">Tell others what you think about this product.
                                                        Be honest and helpful!</div>
                                                </div>

                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="reviews-list mt-5">
                                            <h4>Customer Reviews</h4>

                                            <!-- Review Item -->
                                            <div class="review-item">
                                                <div class="review-header">
                                                    <div class="reviewer-info">
                                                        <img src="assets/img/person/person-m-1.webp" alt="Reviewer"
                                                            class="reviewer-avatar">
                                                        <div>
                                                            <h5 class="reviewer-name">John Doe</h5>
                                                            <div class="review-date">03/15/2024</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-rating">
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                    </div>
                                                </div>
                                                <h5 class="review-title">Exceptional sound quality and comfort</h5>
                                                <div class="review-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
                                                        at lacus congue, suscipit elit nec, tincidunt orci. Phasellus
                                                        egestas nisi vitae lectus imperdiet venenatis. Suspendisse vulputate
                                                        quam diam, et consectetur augue condimentum in.</p>
                                                </div>
                                            </div><!-- End Review Item -->

                                            <!-- Review Item -->
                                            <div class="review-item">
                                                <div class="review-header">
                                                    <div class="reviewer-info">
                                                        <img src="assets/img/person/person-f-2.webp" alt="Reviewer"
                                                            class="reviewer-avatar">
                                                        <div>
                                                            <h5 class="reviewer-name">Jane Smith</h5>
                                                            <div class="review-date">02/28/2024</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-rating">
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star"></i>
                                                    </div>
                                                </div>
                                                <h5 class="review-title">Great headphones, battery could be better</h5>
                                                <div class="review-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
                                                        at lacus congue, suscipit elit nec, tincidunt orci. Phasellus
                                                        egestas nisi vitae lectus imperdiet venenatis.</p>
                                                </div>
                                            </div><!-- End Review Item -->

                                            <!-- Review Item -->
                                            <div class="review-item">
                                                <div class="review-header">
                                                    <div class="reviewer-info">
                                                        <img src="assets/img/person/person-m-3.webp" alt="Reviewer"
                                                            class="reviewer-avatar">
                                                        <div>
                                                            <h5 class="reviewer-name">Michael Johnson</h5>
                                                            <div class="review-date">02/15/2024</div>
                                                        </div>
                                                    </div>
                                                    <div class="review-rating">
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-half"></i>
                                                    </div>
                                                </div>
                                                <h5 class="review-title">Impressive noise cancellation</h5>
                                                <div class="review-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum
                                                        at lacus congue, suscipit elit nec, tincidunt orci. Phasellus
                                                        egestas nisi vitae lectus imperdiet venenatis. Suspendisse vulputate
                                                        quam diam.</p>
                                                </div>
                                            </div><!-- End Review Item -->

                                            <div class="text-center mt-4">
                                                <button class="btn btn-outline-primary load-more-btn">Load More
                                                    Reviews</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Product Details Section -->
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

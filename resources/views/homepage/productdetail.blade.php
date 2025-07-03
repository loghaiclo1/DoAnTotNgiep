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
                        <li><a href="{{ url('/category/' . $book->category->slug) }}">{{ $book->category->name }}</a></li>
                        <li class="current">{{ $book->TenSach }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div id="reviews-list-container" data-book-id="{{ $book->MaSach }}">

        <section id="product-details" class="product-details section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
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
                                    <span class="discount-badge">-{{ round(100 - ($book->GiaBan / $book->GiaCu) * 100) }}%</span>
                                @endif
                            </div>

                            {{-- <div class="product-availability mb-4">
                                @if ($book->SoLuong > 0)
                                    <i class="bi bi-check-circle-fill text-success"></i> <span>Còn hàng</span>
                                @else
                                    <i class="bi bi-x-circle-fill text-danger"></i> <span>Hết hàng</span>
                                @endif
                            </div> --}}

                            @php
                            $currentQty = session('cart.' . $book->MaSach . '.quantity', 0);
                            // Không cần tính $availableQty ở đây, để server xử lý
                            @endphp

                            @if ($book->SoLuong > 0)
                                <form class="add-to-cart-form" action="{{ route('cart.add') }}" method="POST" data-book-id="{{ $book->MaSach }}">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->MaSach }}">
                                    <div class="product-quantity mb-4">
                                        <h6 class="option-title">Số lượng:</h6>
                                        <div class="quantity-selector" data-book-id="{{ $book->MaSach }}">
                                            <button type="button" class="quantity-btn decrease"><i class="bi bi-dash"></i></button>
                                            <input type="number" class="quantity-input" name="quantity" value="1" min="1" required>
                                            <button type="button" class="quantity-btn increase"><i class="bi bi-plus"></i></button>
                                        </div>
                                        <div class="error-message text-danger mt-2"></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary add-to-cart-btn">Thêm vào giỏ hàng</button>
                                </form>
                            @else
                                <p class="text-danger">Hết hàng!</p>
                            @endif
                            @php
                                $average = number_format($averageRating, 1);
                                $percentAverage = $averageRating > 0 ? ($averageRating / 5) * 100 : 0;
                            @endphp

                            <div class="d-flex align-items-center bg-white p-4 ps-0 rounded mb-4">
                                {{-- Cột trái: Điểm trung bình --}}
                                <div class="text-center" style="flex: 0 0 30%;">
                                    <div class="display-4 fw-bold">
                                        {{ $average }}<span class="fs-5 text-muted">/5</span>
                                    </div>
                                    {{-- Hiển thị sao thay progress --}}
                                    <div class="my-2">
                                        @php
                                            $fullStars = floor($average);
                                            $halfStar = ($average - $fullStars) >= 0.5;
                                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                        @endphp

                                        {{-- Sao đầy --}}
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                        @endfor

                                        {{-- Nửa sao nếu cần --}}
                                        @if ($halfStar)
                                            <i class="bi bi-star-half text-warning fs-5"></i>
                                        @endif

                                        {{-- Sao rỗng --}}
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="bi bi-star text-warning fs-5"></i>
                                        @endfor
                                    </div>

                                    <div class="text-muted small">({{ $reviewCount }} đánh giá)</div>
                                </div>

                                {{-- Cột phải: Rating breakdown --}}
                                <div class="ms-4 flex-grow-1">
                                    @foreach ([5,4,3,2,1] as $star)
                                        @php
                                            $count = $ratingDistribution[$star] ?? 0;
                                            $percent = $reviewCount > 0 ? ($count / $reviewCount) * 100 : 0;
                                        @endphp
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span style="width: 70px;">{{ $star }} sao <span class="text-muted small">({{ $count }})</span> </span>
                                            <div class="progress flex-grow-1" style="height: 8px;">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <span style="width: 40px; text-align: right;">{{ number_format($percent, 0) }}%</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Details Tabs -->
                    <div class="row mt-5" data-aos="fade-up">
                        <div class="col-12" style="margin-top: -50px">
                            <div class="product-details-tabs">
                                <ul class="nav nav-tabs" id="productTabs" role="tablist" style="margin-bottom: -10px">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                            data-bs-target="#description" type="button" role="tab"
                                            aria-controls="description" aria-selected="true">Giới thiệu sách</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="specifications-tab" data-bs-toggle="tab"
                                            data-bs-target="#specifications" type="button" role="tab"
                                            aria-controls="specifications" aria-selected="false">Thông tin tác phẩm</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                                            type="button" role="tab" aria-controls="reviews" aria-selected="false">Đánh giá ({{$reviewCount }})</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="productTabsContent">
                                    <!-- Description Tab -->
                                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                                        aria-labelledby="description-tab">
                                        <div class="product-description">
                                            <p style="margin-top: 20px">{!! nl2br(e($book->MoTa)) !!}</p>
                                            <h4>Tính năng chính</h4>
                                            <ul>
                                                <li>Lorem ipsum dolor sit amet</li>
                                                <li>Vestibulum at lacus congue</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Specifications Tab -->
                                    <div class="tab-pane fade" id="specifications" role="tabpanel"
                                        aria-labelledby="specifications-tab">
                                        <div class="product-specifications">
                                            <div class="specs-group">
                                                <div class="specs-table">
                                                    <div class="specs-row">
                                                        <div class="specs-label">Tên sách</div>
                                                        <div class="specs-value">{{ $book->TenSach }}</div>
                                                    </div>
                                                    <div class="specs-row">
                                                        <div class="specs-label">Danh mục</div>
                                                        <div class="specs-value">{{ $book->category->name ?? 'Chưa có danh mục' }}</div>
                                                    </div>
                                                    <div class="specs-row">
                                                        <div class="specs-label">Năm xuất bản</div>
                                                        <div class="specs-value">{{ $book->NamXuatBan ?? 'Đang cập nhật' }}</div>
                                                    </div>
                                                    <div class="specs-row">
                                                        <div class="specs-label">Giá bán</div>
                                                        <div class="specs-value">{{ number_format($book->GiaBan, 0, ',', '.') }}₫</div>
                                                    </div>
                                                    <div class="specs-row">
                                                        <div class="specs-label">Số lượng trong kho</div>
                                                        <div class="specs-value">{{ $book->SoLuong > 0 ? $book->SoLuong . ' cuốn' : 'Hết hàng' }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Reviews Tab -->
                                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                        {{-- Bộ lọc --}}
                                        <div id="reviews-block">
                                            @include('components.reviews-block', ['reviews' => $reviews])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')

@push('scripts')
<script>
    window.bookId = {{ $book->MaSach }};
</script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function(){
    function loadReviews(url) {
        $.get(url, function(data){
            $('#reviews-list-container').html(data);
            window.history.pushState({}, '', url);
        });
    }

    // Filter star buttons
    $(document).on('click', '.review-filter-btn', function(e){
        e.preventDefault();
        let url = $(this).attr('href');
        loadReviews(url);
    });

    // Sort select change
    $(document).on('change', '.sort-select', function(){
        let url = new URL(window.location.href);
        url.searchParams.set('sort', $(this).val());
        loadReviews(url.toString());
    });

    // Pagination links
    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
        let url = $(this).attr('href');
        loadReviews(url);
    });
});
</script>
@endpush


@endsection

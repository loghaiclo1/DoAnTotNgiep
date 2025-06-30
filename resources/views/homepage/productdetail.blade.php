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

                            <div class="product-availability mb-4">
                                @if ($book->SoLuong > 0)
                                    <i class="bi bi-check-circle-fill text-success"></i> <span>Còn hàng</span>
                                @else
                                    <i class="bi bi-x-circle-fill text-danger"></i> <span>Hết hàng</span>
                                @endif
                            </div>

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
                                            aria-controls="description" aria-selected="true">Mô tả</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="specifications-tab" data-bs-toggle="tab"
                                            data-bs-target="#specifications" type="button" role="tab"
                                            aria-controls="specifications" aria-selected="false">Thông số</button>
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
                                            <h4>Tổng quan sản phẩm</h4>
<p>{!! nl2br(e($book->MoTa)) !!}</p>
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
                                                <h4>Thông số kỹ thuật</h4>
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
                                        <div class="product-reviews">
    <h4>Đánh giá sản phẩm</h4>
    @forelse($book->reviews as $review)
        <div class="review border rounded p-3 mb-2">
<strong>{{ ($review->user->Ho ?? '') . ' ' . ($review->user->Ten ?? '') ?: 'Khách' }}</strong>
            <span class="text-warning">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $review->SoSao)
                        ★
                    @else
                        ☆
                    @endif
                @endfor
            </span>
            <p>{{ $review->NoiDung }}</p>
            <small class="text-muted">{{ \Carbon\Carbon::parse($review->NgayDanhGia)->format('d/m/Y H:i') }}</small>
        </div>
    @empty
        <p>Chưa có đánh giá cho sản phẩm này.</p>
    @endforelse
    @if(auth()->check())
    <hr>
    <h5>Viết đánh giá của bạn</h5>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('review.store') }}" method="POST">
        @csrf
        <input type="hidden" name="MaSach" value="{{ $book->MaSach }}">

        <div class="mb-3">
            <label for="SoSao" class="form-label">Số sao:</label>
            <select name="SoSao" id="SoSao" class="form-select" required>
                <option value="">Chọn số sao</option>
                @for($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}">{{ $i }} sao</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="NoiDung" class="form-label">Nội dung đánh giá:</label>
            <textarea name="NoiDung" id="NoiDung" rows="3" class="form-control" placeholder="Hãy chia sẻ trải nghiệm của bạn..." required>{{ old('NoiDung') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
    </form>
@else
    <hr>
    <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để gửi đánh giá.</p>
@endif

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
    </script>
@endsection

@extends('layout.main')

@section('title', $category->name)

@section('content')
    <main class="main">
        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">{{ $category->name }}</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ url('/') }}">Trang chủ</a></li>
                        <li class="current">{{ $category->name }}</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <div class="container py-5">
            <div class="row gy-4">
                @forelse ($books as $book)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product-box" style="height: 435px">
                            <div class="product-thumb" style="position: relative; height: 261.33px;">
                                <img src="{{ asset('image/book/' . $book->HinhAnh) }}" alt="{{ $book->TenSach }}"
                                    style="width: 100%; height: 261.33px; object-fit: contain;">
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
                                    <h3 class="product-title" style="height: 20px; font-size: 20px; margin-top: 10px;">
                                        <a href="{{ route('product.detail', $book->slug) }}" style="color: #2D465E">
                                            {{ $book->TenSach }}
                                        </a>
                                    </h3>

                                    <div class="product-price" style="color: #e53e3e; font-weight: 700;">
                                        @if ($book->GiaGoc && $book->GiaGoc > $book->GiaBan)
                                            <span class="original current-price-original">
                                                {{ number_format($book->GiaGoc, 0, ',', '.') }}đ
                                            </span>
                                        @endif
                                        <span class="sale current-price">
                                            {{ number_format($book->GiaBan, 0, ',', '.') }}đ
                                        </span>
                                    </div>
                                </div>

                                {{-- Đánh giá --}}
                                <div class="product-rating-container">
                                    @php
                                        $rating = $book->avg_rating ?? 0;
                                        $reviewsCount = $book->reviews_count ?? 0;
                                    @endphp
                                    <div class="rating-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($rating >= $i)
                                                <i class="bi bi-star-fill text-warning"></i>
                                            @elseif ($rating >= $i - 0.5)
                                                <i class="bi bi-star-half text-warning"></i>
                                            @else
                                                <i class="bi bi-star text-warning"></i>
                                            @endif
                                        @endfor
                                        <span class="rating-number"
                                            style="    font-size: 0.85rem;    font-weight: 600;">{{ $reviewsCount }} đánh
                                            giá</span>

                                    </div>
                                </div>

                                {{-- Lượt mua --}}
                                <div style="color: #7A7E7F; margin-bottom: 5px;">
                                    Đã bán {{ $book->LuotMua ?? 0 }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">Danh mục này chưa có sách nào.</div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $books->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </main>
@endsection
@push('scripts')
    <style>
        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-thumb:hover .product-overlay {
            opacity: 1;
            visibility: visible;
        }
    </style>
@endpush

@extends('layout.main')

@section('title', $category->name)

@section('content')
    <main class="main">
        <section id="product-list" class="product-list section">
            <div class="container isotope-layout aos-init" data-aos="fade-up" data-aos-delay="100" data-default-filter="*"
                data-layout="masonry" data-sort="original-order">
                <div class="page-title">
                        <div class="container d-lg-flex justify-content-between align-items-center">
                            <h1 class="mb-2 mb-lg-0">{{ $category->name }}</h1>
                        </div>
                    </div>
                <div class="row product-container isotope-container aos-init" data-aos="fade-up" data-aos-delay="200">

                    @foreach ($books as $book)
                        <div class="col-md-6 col-lg-3 product-item isotope-item ">
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="{{ asset('./image/book/' . $book->HinhAnh) }}" alt="{{ $book->TenSach }}"
                                        class="img-fluid uniform-img" loading="lazy">
                                        <div class="product-overlay" data-book-id="{{ $book->MaSach }}">
                                            @if ($book->SoLuong <= 0)
                                                <button class="btn btn-secondary btn-add-to-cart btn-disabled" disabled>
                                                    <i class="bi bi-bag-plus me-2"></i>Hết hàng
                                                </button>
                                            @else
                                                <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                                    @csrf
                                                    <input type="hidden" name="book_id" value="{{ $book->MaSach }}">
                                                    <button type="submit" class="btn btn-primary btn-add-to-cart">
                                                        <i class="bi bi-bag-plus me-2"></i>Thêm vào giỏ
                                                    </button>
                                                </form>
                                            @endif
                                        </div>

                                </div>
                                <div class="product-info">
                                    <h5 class="product-title"><a href="#">{{ $book->TenSach }}</a></h5>
                                    <div class="product-price">
                                        <span class="current-price" data-book-id="{{ $book->MaSach }}">
                                            {{ number_format($book->GiaBan, 0, ',', '.') }}₫
                                        </span>

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
            </div>
        </section>
    </main>
@endsection

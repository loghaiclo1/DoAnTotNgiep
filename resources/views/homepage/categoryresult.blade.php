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
                                    <div class="product-overlay">
                                        <a href="#" class="btn-cart"><i class="bi bi-cart-plus"></i> Thêm vào
                                            giỏ</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-title"><a href="#">{{ $book->TenSach }}</a></h5>
                                    <div class="product-price">
                                        <span class="current-price">{{ number_format($book->GiaBan, 0, ',', '.') }}₫</span>
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

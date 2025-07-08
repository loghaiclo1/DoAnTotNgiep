@extends('layout.main')

@section('content')
<section id="product-list" class="product-list section">
    <div class="container isotope-layout aos-init" data-aos="fade-up" data-aos-delay="100" data-default-filter="*" data-layout="masonry" data-sort="original-order">
        <!-- Bộ lọc -->
        <div class="row">
            <div class="col-12">
                <div class="product-filters isotope-filters d-flex justify-content-center aos-init" data-aos="fade-up">
                    <ul class="d-flex flex-wrap gap-2 list-unstyled">
                        <div class="container section-title aos-init" data-aos="fade-up">
                            <h2>Kết quả tìm kiếm cho "{{ $query }}"</h2>
                            <p>Có {{ $books->total() }} sản phẩm cho tìm kiếm</p>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="product-filters isotope-filters d-flex justify-content-center aos-init" data-aos="fade-up">
            <ul class="d-flex flex-wrap gap-2 list-unstyled">
                <li>
                    <select id="price-filter" onchange="applyPriceFilter(this.value)">
                        <option value="">Sắp xếp theo giá</option>
                        <option value="high-to-low" {{ request('sort') == 'high-to-low' ? 'selected' : '' }}>Giá: Cao đến thấp</option>
                        <option value="low-to-high" {{ request('sort') == 'low-to-high' ? 'selected' : '' }}>Giá: Thấp đến cao</option>
                    </select>
                </li>
            </ul>
        </div>
        <!-- Danh sách sách -->
        <div class="row product-container isotope-container aos-init" data-aos="fade-up" data-aos-delay="200">
            @foreach ($books as $book)
                <div class="col-md-6 col-lg-3 product-item isotope-item">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('./image/book/' . $book->HinhAnh) }}" alt="{{ $book->TenSach }}" style="object-fit: cover">
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
                        <div class="product-info">
                            <h5 class="product-title"><a href="{{ route('product.detail', ['slug' => $book->slug]) }}">{{ $book->TenSach }}</a></h5>
                            <div class="product-price">
                                <span class="current-price">{{ number_format($book->GiaBan, 0, ',', '.') }}₫</span>
                            </div>
                            <div class="product-rating">
                                <span>( {{ $book->LuotMua }} lượt bán )</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="pagination d-flex justify-content-center">
                    {{ $books->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

    </div>
</section>
<script>
    function applyPriceFilter(value) {
        const url = new URL(window.location.href);
        if (value) {
            url.searchParams.set('sort', value);
        } else {
            url.searchParams.delete('sort');
        }
        window.location.href = url.toString();
    }
    </script>
@endsection

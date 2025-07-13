@if(!empty($mergedBooks) && count($mergedBooks) > 0)
<section id="suggested-books" class="best-sellers section mt-5">
    <div class="container section-title aos-init" data-aos="fade-up">
        <h2>Gợi ý cho bạn</h2>
        <p>Các cuốn sách phù hợp với sở thích và hành vi của bạn</p>
    </div>

    <div class="container aos-init" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            @foreach ($mergedBooks as $index => $book)
                <div class="col-md-6 col-lg-2 aos-init" data-aos="fade-up" data-aos-delay="{{ 100 + $index * 50 }}">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('image/book/' . $book->HinhAnh) }}" alt="{{ $book->TenSach }}" loading="lazy">
                            <div class="product-actions">
                                <button class="btn-quickview" type="button" aria-label="Xem nhanh">
                                    <a href="{{ route('product.detail', $book->slug) }}">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </button>
                            </div>
                        </div>

                        <div class="product-info">
                            <h3 class="product-title" style="height: 20px;">
                                <a href="{{ route('product.detail', $book->slug) }}">{{ $book->TenSach }}</a>
                            </h3>
                            <div class="product-price">
                                <span class="current-price">
                                    {{ number_format($book->GiaBan, 0, ',', '.') }}₫
                                </span>
                            </div>
                            <div class="add-to-cart-container mt-2" data-book-id="{{ $book->MaSach }}">
                                @if ($book->SoLuong <= 0)
                                    <button class="btn btn-secondary btn-add-to-cart btn-disabled w-100" disabled>
                                        <i class="bi bi-bag-plus me-2"></i>Hết hàng
                                    </button>
                                @else
                                    <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->MaSach }}">
                                        <button class="btn btn-primary btn-add-to-cart w-100" type="submit">
                                            <i class="bi bi-bag-plus me-2"></i>Thêm vào giỏ
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

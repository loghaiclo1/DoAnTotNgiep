@if($sachGoiY->isNotEmpty())
    <section class="suggested-books mt-5">
        <div class="container">
            <h2 class="mb-4"> Gợi ý cho bạn</h2>
            <div class="row">
                @foreach($sachGoiY as $sach)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $sach->HinhAnh) }}" class="card-img-top" alt="{{ $sach->TenSach }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $sach->TenSach }}</h5>
                                <p class="card-text">{{ number_format($sach->GiaBan) }} ₫</p>
                                <a href="{{ route('product.detail', $sach->slug) }}" class="btn btn-primary">Xem chi tiết</a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

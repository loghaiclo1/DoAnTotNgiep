<div class="reviews-grid">
    @forelse($reviews as $review)
        <div class="review-card" data-aos="fade-up">
            <div class="review-header">
                <img src="{{ asset('image/book/' . ltrim($review->book->HinhAnh ?? 'no-image.png', '/')) }}"
                     alt="{{ $review->book->TenSach ?? 'Sách' }}"
                     class="product-image"
                     loading="lazy">
                <div class="review-meta">
                    <h4>
                        <a href="{{ route('product.detail', $review->book->slug) }}" class="text-decoration-none">
                            {{ $review->book->TenSach ?? 'Sách không tồn tại' }}
                        </a>
                    </h4>
                    <div class="rating">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->SoSao)
                                <i class="bi bi-star-fill text-warning"></i>
                            @else
                                <i class="bi bi-star"></i>
                            @endif
                        @endfor
                        <span>({{ number_format($review->SoSao, 1) }})</span>
                        <span class="review-date">
                            - {{ \Carbon\Carbon::parse($review->NgayDanhGia)->format('d/m/Y H:i') }}
                        </span>
                    </div>
                    <div class="review-content">
                        <p class="mb-0">{{ $review->NoiDung }}</p>
                    </div>
                </div>
            </div>

            <div class="review-footer mt-2">
                <button type="button"
                        class="edit-review-btn btn btn-sm btn-outline-primary me-2"
                        data-id="{{ $review->MaDanhGia }}"
                        data-sosao="{{ $review->SoSao }}"
                        data-noidung="{{ e($review->NoiDung) }}">
                    <i class="bi bi-pencil"></i> Sửa
                </button>

                <form method="POST"
                      action="{{ route('review.destroy', $review->MaDanhGia) }}"
                      onsubmit="return confirm('Xác nhận xoá đánh giá?')"
                      style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash"></i> Xoá
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-center text-muted">Bạn chưa có đánh giá nào.</p>
    @endforelse
</div>

@if ($reviews->hasPages())
    <div class="d-flex justify-content-center mt-3">
        {{ $reviews->fragment('reviews')->links('pagination::bootstrap-5') }}
    </div>
@endif

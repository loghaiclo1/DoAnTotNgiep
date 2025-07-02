@forelse($reviews as $review)
    <div class="review rounded mb-2 d-flex">
        <div class="me-3 flex-shrink-0">
            <img src="{{ asset('image/' . ($review->user->avatar ?? 'default.png')) }}" alt="Avatar"
                class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
        </div>
        <div>
            <strong>{{ ($review->user->Ho ?? '') . ' ' . ($review->user->Ten ?? '') ?: 'Khách' }}</strong>
            <span class="text-warning">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $review->SoSao)
                        ★
                    @else
                        ☆
                    @endif
                @endfor
            </span>

            @if ($review->TrangThai == 2)
                <p class="mb-1 text-muted fst-italic">Nội dung đã bị ẩn bởi quản trị viên.</p>
            @else
                <p class="mb-1">{{ $review->NoiDung }}</p>
            @endif

            <small class="text-muted">
                {{ \Carbon\Carbon::parse($review->NgayDanhGia)->format('d/m/Y H:i') }}
            </small>
        </div>
    </div>
@empty
    <p class="text-muted">Chưa có đánh giá cho sản phẩm này.</p>
@endforelse

@if ($reviews->hasPages())
    <div class="mt-3">
        {{ $reviews->links() }}
    </div>
@endif

<div class="product-reviews mt-3">
    {{-- Bộ lọc --}}
    <form method="GET" id="review-filter-form" class="d-flex align-items-center gap-2 mb-3 flex-wrap">
        @php
            $currentStar = request('star');
            $currentSort = request('sort') ?? 'newest';
            $isAllActive = $currentStar == '';
        @endphp

        {{-- Filter sao --}}
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ request()->fullUrlWithQuery(['star' => '']) }}"
                class="btn btn-sm review-filter-btn {{ $isAllActive ? 'text-danger border-danger' : 'text-black border-dark' }} border">
                Tất cả
            </a>
            @for ($i = 5; $i >= 1; $i--)
                @php
                    $isActive = $currentStar == $i;
                @endphp
                <a href="{{ request()->fullUrlWithQuery(['star' => $isActive ? '' : $i]) }}"
                    class="btn btn-sm review-filter-btn {{ $isActive ? 'text-danger border-danger' : 'text-black border-dark' }} border">
                    {{ $i }} ★
                </a>
            @endfor
        </div>

        {{-- Sort --}}
        <select name="sort" class="form-select form-select-sm w-auto sort-select">
            <option value="newest" {{ $currentSort == 'newest' ? 'selected' : '' }}>Mới nhất</option>
            <option value="oldest" {{ $currentSort == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
            <option value="high_rating" {{ $currentSort == 'high_rating' ? 'selected' : '' }}>Sao cao → thấp</option>
            <option value="low_rating" {{ $currentSort == 'low_rating' ? 'selected' : '' }}>Sao thấp → cao</option>
        </select>
    </form>

    {{-- AJAX will load review list here --}}
    <div id="reviews-list-container">
        @include('components.reviews-list', ['reviews' => $reviews])
    </div>
</div>

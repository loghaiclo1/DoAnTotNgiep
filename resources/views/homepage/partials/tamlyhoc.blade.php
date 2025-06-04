@foreach ($tamLyHoc as $post)
<div class="article-item mb-4">
    <div class="row g-3 align-items-stretch">
        <div class="col-md-4">
            <img src="{{ asset('storage/bookimage/' . $post->anhbaiviet)}}" alt="{{ $post->tieude }}" class="img-fluid uniform-img" loading="lazy">
        </div>
        <div class="col-md-8 d-flex flex-column justify-content-between">
            <h5 class="article-title fw-bold">
                <a href="{{ route('about.show', $post->slug) }}" class="text-dark text-decoration-none title-hover">{{ $post->tieude }}</a>
            </h5>
            <p class="article-excerpt text-muted mb-2">{{ Str::limit(strip_tags($post->noidung), 100) }}</p>
            <small class="text-muted">{{ $post->created_at->format('d/m/Y') }}</small>
        </div>
    </div>
</div>
@endforeach

<div class="d-flex justify-content-center mt-4">
    {{ $tamLyHoc->appends(request()->except('tamLyHoc_page'))->links('pagination::bootstrap-5') }}
</div>

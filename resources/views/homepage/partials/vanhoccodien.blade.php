<div class="row">
    @foreach ($vanHocCoDien as $post)
        <div class="col-md-6 mb-4">
            <div class="position-relative card-post">
                <img src="{{ asset('storage/bookimage/' . $post->anhbaiviet)}}" alt="{{ $post->tieude }}" class="img-fluid uniformi-img" loading="lazy">
                <a href="{{ route('about.show', $post->slug) }}" class="post-title d-block mt-2 text-dark text-decoration-none fw-bold title-hover">{{ $post->tieude }}</a>
                <div class="meta-info text-muted">{{ $post->created_at->format('d/m/Y') }}</div>
                <p class="text-muted">{{ Str::limit(strip_tags($post->noidung), 100) }}</p>
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $vanHocCoDien->appends(request()->except('vanHocCoDien_page'))->links('pagination::bootstrap-5') }}
</div>

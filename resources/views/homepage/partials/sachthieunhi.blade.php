<div class="row g-4">
    @foreach ($sachThieuNhi as $post)
    <div class="col-md-6 news-item mb-4">
      <div class="row g-3 align-items-stretch">
        <div class="col-4">
          <img src="{{ asset('storage/bookimage/' . $post->anhbaiviet)}}" alt="{{ $post->tieude }}" class="img-fluid uniform-img" loading="lazy">
        </div>
        <div class="col-8 d-flex flex-column justify-content-between">
          <a href="{{ route('about.show', $post->slug) }}" class="news-title text-dark text-decoration-none fw-bold title-hover">{{ $post->tieude }}</a>
          <div class="news-meta text-muted">{{ $post->created_at->format('d/m/Y') }}</div>
          <div class="news-desc text-muted">{{ Str::limit(strip_tags($post->noidung), 100) }}</div>
        </div>
      </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center mt-4 w-100">
      {{ $sachThieuNhi->appends(request()->except('sachThieuNhi_page'))->links('pagination::bootstrap-5') }}
    </div>
  </div>

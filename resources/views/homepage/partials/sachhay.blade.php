<section id="sach-hay" class="sach-hay section py-5" aria-labelledby="sach-hay-title">
    <div class="container">
      <h2 id="sach-hay-title" class="fw-bold text-dark mb-4 border-bottom border-danger pb-2">SÁCH HAY</h2>

      <div class="row g-4">
        <div class="col-lg-8">
          @if ($sachHay->count() > 0)
            @php $firstPost = $sachHay->first(); @endphp
            <div class="article-item mb-4">
              <div class="d-flex flex-column">
                <img src="{{ asset('storage/bookimage/' . $firstPost->anhbaiviet) }}" alt="{{ $firstPost->tieude }}" class="img-fluid" style="width: 40%; height: 40%; object-fit: cover;" loading="lazy">
                <h5 class="article-title fw-bold mb-1">
                  <a href="{{ route('about.show', $firstPost->slug) }}" class="text-dark text-decoration-none title-hover">{{ $firstPost->tieude }}</a>
                </h5>
                <p class="article-excerpt text-muted mb-1" style="line-height: 1.4;">{{ Str::limit(strip_tags($firstPost->noidung), 80) }}</p>
                <small class="text-muted">{{ $firstPost->created_at->format('d/m/Y') }}</small>
              </div>
            </div>
          @endif
        </div>

        <div class="col-lg-4">
          <div class="sidebar">
            @foreach ($sachHay->skip(1) as $post)
              <div class="sidebar-item mb-3">
                <div class="row g-2 align-items-center">
                  <div class="col-4">
                    <img src="{{ asset('storage/bookimage/' . $post->anhbaiviet) }}" alt="{{ $post->tieude }}" class="img-fluid" style="height: 120px; object-fit: cover;" loading="lazy">
                  </div>
                  <div class="col-8">
                    <h6 class="fw-bold">
                      <a href="{{ route('about.show', $post->slug) }}" class="text-dark text-decoration-none title-hover">{{ $post->tieude }}</a>
                    </h6>
                    <small class="text-muted">{{ $post->created_at->format('d/m/Y') }}</small>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div class="pagination-wrapper">
        {{ $sachHay->links('vendor.pagination.bootstrap-4') }}
      </div>
    </div>
  </section>

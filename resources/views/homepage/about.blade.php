
@extends('layout.main')

@section('title', 'eStore - Giới thiệu')

@section('content')
<main class="main py-5 bg-white">
  <div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
      <h1 class="mb-2 mb-lg-0">Giới Thiệu</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="index.html">Home</a></li>
          <li class="current">Giới Thiệu</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="container my-4">
    <form action="{{ route('about.search') }}" method="GET" class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Tìm kiếm ..." aria-label="Tìm kiếm " name="search" value="{{ request()->get('search') }}">
      <button class="btn btn-outline-danger" type="submit">Tìm</button>
    </form>
</div>

  <section id="sach-hay" class="sach-hay section py-5" aria-labelledby="sach-hay-title">
    <div class="container">
      <h2 id="sach-hay-title" class="fw-bold text-dark mb-4 border-bottom border-danger pb-2">SÁCH HAY</h2>
      <div class="row g-4">
        <div class="col-lg-8">
          @foreach ($sachHay as $post)
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
        </div>
        <div class="col-lg-4">
          <div class="sidebar">
            <h3 class="fw-bold text-dark mb-3 border-bottom border-danger pb-2">MỤC NỔI BẬT</h3>
            @foreach ($sidebarPosts as $post)
            <div class="sidebar-item mb-3">
              <h6 class="fw-bold">
                <a href="{{ route('about.show', $post->slug) }}" class="text-dark text-decoration-none title-hover">{{ $post->tieude }}</a>
              </h6>
              <small class="text-muted">{{ $post->created_at->format('d/m/Y') }}</small>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- <div class="container my-4">
    <h2 class="fw-bold text-dark mb-4 border-bottom border-danger pb-2">VĂN HỌC CỔ ĐIỂN</h2>
    <div class="row">
      @if ($vanHocCoDien->isNotEmpty())
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
      @endif
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $vanHocCoDien->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
    </div>
  </div> --}}
  <div class="container my-4" id="vanhoccodien-section">
    <h2 class="fw-bold text-dark mb-4 border-bottom border-danger pb-2">VĂN HỌC CỔ ĐIỂN</h2>
    <div id="vanhoccodien-content">
        @include('homepage.partials.vanhoccodien', ['vanHocCoDien' => $vanHocCoDien])
    </div>
</div>
{{--
  <section id="" class="section py-5" aria-labelledby="tam-ly-hoc-title">
    <div class="container">
      <h2 id="tam-ly-hoc-title" class="fw-bold text-dark mb-4 border-bottom border-danger pb-2">TÂM LÝ HỌC</h2>
      <div class="row g-4">
        <div class="col-lg-8">
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
        </div>
      </div>
      <div class="d-flex justify-content-center mt-4">
        {{ $tamLyHoc->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
    </div>
    </div>
  </section> --}}
  <section id="tam-ly-hoc-section" class="section py-5" aria-labelledby="tam-ly-hoc-title">
    <div class="container">
        <h2 id="tam-ly-hoc-title" class="fw-bold text-dark mb-4 border-bottom border-danger pb-2">TÂM LÝ HỌC</h2>
        <div id="tamlyhoc-content">
            @include('homepage.partials.tamlyhoc', ['tamLyHoc' => $tamLyHoc])
        </div>
    </div>
</section>
{{--
  <div class="container my-4">
    <h2 class="category-title fw-bold text-dark mb-4 border-bottom border-danger pb-2">SÁCH THIẾU NHI</h2>
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
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $sachThieuNhi->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
    </div>
  </div> --}}
  <section id="sach-thieu-nhi-section" class="section py-5" aria-labelledby="sach-thieu-nhi-title">
    <div class="container">
      <h2 id="sach-thieu-nhi-title" class="fw-bold text-dark mb-4 border-bottom border-danger pb-2">SÁCH THIẾU NHI</h2>
      <div id="sachthieunhi-content">
        @include('homepage.partials.sachthieunhi', ['sachThieuNhi' => $sachThieuNhi])
      </div>
    </div>
  </section>

  <section id="tonghop" class="section py-5" aria-labelledby="tonghop-title">
    <div class="container">
        <h2 id="tonghop-title" class="fw-bold text-dark mb-4 border-bottom border-danger pb-2">TỔNG HỢP</h2>
        <div class="row g-4">
            <div class="col-lg-8">
                @foreach ($tongHop as $post)
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
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $tongHop->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>

</main>
<script>
    window.routes = {
      vanHocCoDienAjax: "{{ route('about.vanhoccodien.ajax') }}",
      tamLyHocAjax: "{{ route('about.tamlyhoc.ajax') }}",
      sachThieuNhiAjax: "{{ route('about.sachthieunhi.ajax') }}"
    };
  </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/ajax-pagination.js') }}"></script>

@endsection

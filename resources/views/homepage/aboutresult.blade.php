@extends('layout.main')

@section('title', 'eStore - Giới thiệu')
@section('content')
<main class="main py-5 bg-white">
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Kết quả tìm kiếm: {{ $query ?? 'Không có từ khóa' }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a>Home</a></li>
                    <li class="current">Kết quả tìm kiếm</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container my-4">
        <form action="{{ route('about.search') }}" method="GET" class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Tìm kiếm ..." aria-label="Tìm kiếm " name="search" value="{{ $query ?? '' }}">
            <button class="btn btn-outline-danger" type="submit">Tìm</button>
        </form>
    </div>

    <section class="section py-5" aria-labelledby="search-results-title">
        <div class="container">
            <h2 id="search-results-title" class="fw-bold text-dark mb-4 border-bottom border-danger pb-2">KẾT QUẢ TÌM KIẾM</h2>
            <div class="row g-4">
                <p>Kết quả tìm kiếm: {{ $results->count() }} bài viết</p>
                @forelse ($results as $post)
                <div class="col-md-6 mb-4">
                    <div class="article-item">
                        <div class="row g-3 align-items-stretch">
                            <div class="col-md-4">
                                @if($post->anhbaiviet && file_exists(public_path('storage/bookimage/' . $post->anhbaiviet)))
                                    <img src="{{ asset('storage/bookimage/' . $post->anhbaiviet) }}" alt="{{ $post->tieude }}" class="img-fluid uniform-img" loading="lazy">
                                @else
                                    <img src="{{ asset('images/default.jpg') }}" alt="Hình mặc định" class="img-fluid uniform-img" loading="lazy">
                                @endif
                            </div>
                            <div class="col-md-8 d-flex flex-column justify-content-between">
                                <h5 class="article-title fw-bold">
                                    <a href="{{ route('about.show', $post->slug) }}" class="text-dark text-decoration-none title-hover">{{ $post->tieude }}</a>
                                </h5>
                                <p class="article-excerpt text-muted mb-2">{{ Str::limit(strip_tags($post->noidung), 100) }}</p>
                                <small class="text-muted">Chủ đề: {{ $post->chude }}</small><br>
                                <small class="text-muted">Ngày đăng: {{ $post->created_at->format('d/m/Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Không có kết quả nào phù hợp.</p>
                <p class="text-muted">Nếu bạn không hài lòng với kết quả, hãy thử tìm kiếm lại.</p>
            @endforelse
            <div class="d-flex justify-content-center mt-4">
                {{ $results->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
            </div>
        </div>
    </section>
</main>

@endsection

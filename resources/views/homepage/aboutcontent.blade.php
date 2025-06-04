@extends('layout.main')
@section('title', $article->tieude)

@section('content')
<div class="max-w-5xl mx-auto px-4 md:px-6 lg:px-8 py-12" id="about-page">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 mb-6">
        <a href="{{ route('about.index') }}" class="hover:underline text-indigo-600">Trang chủ</a> >
        <a{{ $article->chude }}" class="hover:underline text-indigo-600">{{ $article->chude }}</a> >
        <span class="text-gray-700">{{ $article->tieude }}</span>
    </nav>

    <h1 class="pt-5 text-4xl md:text-5xl font-extrabold text-center text-gray-900 mb-8 max-w-2xl mx-auto leading-tight break-words hyphens-auto">
        {{ $article->tieude }}
    </h1>
    <!-- Thông tin meta -->
    <div class="text-center text-gray-500 text-sm mb-8" style="padding-bottom: 20px">
        Ngày đăng: {{ \Carbon\Carbon::parse($article->created_at)->format('d/m/Y') }}
    </div>

    @if($article->anhbaiviet)
    <div class="mb-10 text-center">
        <img src="{{ asset('storage/bookimage/' . $article->anhbaiviet) }}"
             alt="{{ $article->tieude }}"
             class="w-full max-w-5xl h-auto mx-auto rounded-lg shadow-lg object-cover">
    </div>
    @endif

    <div class="prose prose-lg text-gray-800 mb-12 text-justify leading-relaxed" style="padding-left:30%; padding-right:30%;padding-top: 20px">
        {!! nl2br(e($article->noidung)) !!}
    </div>

    <div class="container my-4">
        <h2 class="fw-bold text-dark mb-4 border-bottom border-danger pb-2">Bài viết liên quan</h2>
        <div class="row">
          @if (!empty($noidungabout) && $noidungabout->isNotEmpty())
            @foreach ($noidungabout as $post)
            <div class="col-md-6 mb-4">
              <div class="position-relative card-post">
                @if($post->anhbaiviet)
                <img src="{{ asset('storage/bookimage/' . $post->anhbaiviet) }} "
                     alt="{{ $post->tieude }}"
                     class="img-fluid uniformia-img" loading="lazy">
                @endif

                <a href="{{ route('about.show', $post->slug) }}"
                   class="post-title d-block mt-2 text-dark text-decoration-none fw-bold title-hover">
                   {{ $post->tieude }}
                </a>

                <div class="meta-info text-muted">{{ $post->created_at->format('d/m/Y') }}</div>
                <p class="text-muted">{{ Str::limit(strip_tags($post->noidung), 100) }}</p>
              </div>
            </div>
            @endforeach
            <div class="d-flex justify-content-center mt-4">
                {{ $noidungabout->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
            </div>
          @else
            <p class="text-center text-muted">Không có bài viết liên quan.</p>
          @endif
        </div>
      </div>
</div>
@endsection


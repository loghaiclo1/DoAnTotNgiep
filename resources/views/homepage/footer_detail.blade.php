@extends('layout.main')

@section('title', $footer->noi_dung)

@section('content')
    <main class="main">
        <div class="container py-5">
            <h2>{{ $footer->noi_dung }}</h2>
            <div class="mt-4">
                {!! nl2br(e($footer->noi_dung_day_du)) !!}
            </div>
        </div>
    </main>
@endsection

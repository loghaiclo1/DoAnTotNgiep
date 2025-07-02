@extends('adminlte::page')

@section('title', 'Quản lý Đánh giá')

@section('content_header')
    <h1>Quản lý Đánh giá (Đang phát triển)</h1>
@endsection

@section('content')
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <div class="alert alert-info">
        Chức năng quản lý đánh giá đang được phát triển.
    </div>
@endsection

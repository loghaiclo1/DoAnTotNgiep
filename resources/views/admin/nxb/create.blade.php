@extends('adminlte::page')

@section('title', 'Thêm NXB')

@section('content_header')
    <h1>Thêm Nhà Xuất Bản</h1>
@endsection

@section('content')
    <form action="{{ route('admin.nxb.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.nxb.form', ['submit' => 'Thêm'])
    </form>
@endsection

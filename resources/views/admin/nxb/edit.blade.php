@extends('adminlte::page')

@section('title', 'Cập nhật NXB')

@section('content_header')
    <h1>Cập nhật Nhà Xuất Bản</h1>
@endsection

@section('content')
    <form action="{{ route('admin.nxb.update', $nxb->MaNXB) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.nxb.form', ['submit' => 'Cập nhật'])
    </form>
@endsection

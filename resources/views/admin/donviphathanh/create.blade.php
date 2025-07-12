@extends('adminlte::page')

@section('title', 'Thêm đơn vị phát hành')

@section('content_header')
    <h1>Thêm đơn vị phát hành</h1>
@stop

@section('content')
    <form action="{{ route('admin.donviphathanh.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.donviphathanh.form')
    </form>
@stop

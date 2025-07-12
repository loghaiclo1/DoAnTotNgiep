@extends('adminlte::page')

@section('title', 'Cập nhật đơn vị phát hành')

@section('content_header')
    <h1>Cập nhật đơn vị phát hành</h1>
@stop

@section('content')
    <form action="{{ route('admin.donviphathanh.update', $dv->MaDVPH) }}" method="POST" enctype="multipart/form-data">
        @php $edit = true; @endphp
        @include('admin.donviphathanh.form')
    </form>
@stop

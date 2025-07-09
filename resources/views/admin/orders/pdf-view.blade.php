@extends('adminlte::page')

@section('title', 'Xem hóa đơn PDF')

@section('content')
    <h2>Xem hóa đơn #{{ $mahoadon }}</h2>
    <iframe src="{{ route('admin.orders.viewPdf', $mahoadon) }}"
            width="100%"
            height="800px"
            style="border: 1px solid #ccc;"></iframe>
@stop

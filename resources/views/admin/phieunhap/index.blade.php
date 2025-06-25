@extends('adminlte::page')

@section('title', 'Danh sách Phiếu Nhập')

@section('content_header')
    <h1>Danh sách Phiếu Nhập</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã phiếu</th>
                <th>Ngày nhập</th>
                <th>Người nhập</th>
                <th>Ghi chú</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($phieuNhaps as $phieu)
                <tr>
                    <td>{{ $phieu->MaPhieuNhap }}</td>
                    <td>{{ $phieu->NgayNhap }}</td>
                    <td>
                        {{ optional($phieu->nguoi_nhap)->Ho }} {{ optional($phieu->nguoi_nhap)->Ten }}
                    </td>
                    <td>{{ $phieu->GhiChu }}</td>
                    <td>
                        <a href="{{ route('admin.phieunhap.show', $phieu->MaPhieuNhap) }}" class="btn btn-info btn-sm">Chi tiết</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@extends('adminlte::page')

@section('title', 'Danh sách Phiếu Nhập')

@section('content_header')
    <h1>Danh sách Phiếu Nhập</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="GET" class="mb-3">
        <div class="input-group" style="max-width: 400px;">
            <input type="text" name="keyword" class="form-control" placeholder="Tìm theo mã phiếu, ghi chú, người nhập..." value="{{ request('keyword') }}">
            <button type="submit" class="btn btn-primary">Tìm</button>
            @if(request('keyword'))
                <a href="{{ route('admin.phieunhap.index') }}" class="btn btn-secondary">Xóa</a>
            @endif
        </div>
    </form>
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
                            <a href="{{ route('admin.phieunhap.edit', $phieu->MaPhieuNhap) }}" class="btn btn-warning btn-sm">Sửa</a>
        

                    </td>
                </tr>
            @endforeach
        </tbody>
        <div class="mt-3 d-flex justify-content-center">
            {{ $phieuNhaps->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
        </div>
        <div class="text-muted mb-2">
            Hiển thị từ {{ $phieuNhaps->firstItem() }} đến {{ $phieuNhaps->lastItem() }} trong tổng số {{ $phieuNhaps->total() }} kết quả
        </div>
    </table>
@stop

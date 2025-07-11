@extends('adminlte::page')

@section('title', 'Quản lý NXB')

@section('content_header')
    <h1>Danh sách Nhà Xuất Bản</h1>
@endsection

@section('content')
    <a href="{{ route('admin.nxb.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Thêm NXB mới
    </a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="GET" action="{{ route('admin.nxb.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" value="{{ request('keyword') }}"
                   class="form-control" placeholder="Tìm theo tên, email, điện thoại, slug...">

            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Tìm
                </button>
                <a href="{{ route('admin.nxb.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Xóa lọc
                </a>
            </div>
        </div>
    </form>


    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tên NXB</th>
                <th>Email</th>
                <th>Điện thoại</th>
                <th>Website</th>
                <th>Slug</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nxb as $item)
                <tr>
                    <td>{{ $nxb->firstItem() + $loop->index }}</td>
                    <td>{{ $item->TenNXB }}</td>
                    <td>{{ $item->Email }}</td>
                    <td>{{ $item->DienThoai }}</td>
                    <td><a href="{{ $item->Website }}" target="_blank">{{ $item->Website }}</a></td>
                    <td>{{ $item->slug }}</td>
                    <td>
                        <a href="{{ route('admin.nxb.edit', $item->MaNXB) }}" class="btn btn-sm btn-primary">Sửa</a>
                        <form action="{{ route('admin.nxb.destroy', $item->MaNXB) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Xác nhận xóa?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3 d-flex justify-content-center">
        {{ $nxb->appends(request()->all())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}

    </div>

    <div class="text-muted mb-2">
        Hiển thị từ {{ $nxb->firstItem() }} đến {{ $nxb->lastItem() }} trong tổng số {{ $nxb->total() }} kết quả
    </div>
@endsection


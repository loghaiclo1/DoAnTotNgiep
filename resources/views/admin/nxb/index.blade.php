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
            <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm..." value="{{ request('keyword') }}">

            <select name="status" class="form-select" style="max-width: 180px;">
                <option value="">-- Tất cả trạng thái --</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Đang hiển thị</option>
                <option value="hidden" {{ request('status') == 'hidden' ? 'selected' : '' }}>Đã bị ẩn</option>
            </select>

            <button class="btn btn-secondary" type="submit">
                <i class="fas fa-search"></i> Lọc
            </button>
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
                <th>Ảnh</th>
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
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Ảnh" width="60">
                        @else
                            <span class="text-muted">Không có ảnh</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.nxb.edit', $item->MaNXB) }}" class="btn btn-sm btn-primary">Sửa</a>

                        @if ($item->trashed())
                            <form action="{{ route('admin.nxb.restore', $item->MaNXB) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Khôi phục NXB này?')">
                                @csrf
                                <button class="btn btn-sm btn-success">Hiện lại</button>
                            </form>
                        @else
                            <form action="{{ route('admin.nxb.hide', $item->MaNXB) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Ẩn NXB này?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-warning">Ẩn</button>
                            </form>
                        @endif
                    </td>

                </tr>
            @endforeach
            @if ($hasHidden)
    <tr>
        <td colspan="8" class="text-muted text-center fst-italic bg-light">
            Một số nhà xuất bản đã bị ẩn và được hiển thị ở cuối danh sách.
        </td>
    </tr>
@endif
        </tbody>
    </table>

    <div class="mt-3 d-flex justify-content-center">
        {{ $nxb->appends(request()->all())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}

    </div>

    <div class="text-muted mb-2">
        Hiển thị từ {{ $nxb->firstItem() }} đến {{ $nxb->lastItem() }} trong tổng số {{ $nxb->total() }} kết quả
    </div>
@endsection


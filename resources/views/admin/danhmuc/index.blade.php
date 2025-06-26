@extends('adminlte::page')

@section('title', 'Quản lý Danh mục')

@section('content_header')
    <h1>Danh sách Danh mục</h1>
@endsection

@section('content')
    {{-- Thông báo thành công --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Thông báo lỗi --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Lỗi!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Form tìm kiếm --}}
    <div class="mb-3">
        <form action="{{ route('admin.categories.index') }}" method="GET" class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="Tìm theo tên, slug, hoặc danh mục cha">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Đặt lại</a>
            </div>
        </form>
    </div>
{{-- Bộ lọc danh mục con cuối cùng --}}
<form action="{{ route('admin.categories.index') }}" method="GET">
    <div class="mb-3">
        <label class="form-label fw-bold">Danh mục:</label>
        <div class="d-flex flex-wrap gap-2">
            @foreach ($tatCaDanhMucCha as $parent)
                <label class="btn btn-outline-light btn-sm" style="border: 1px solid #999;">
                    <input type="checkbox" name="filter_parent[]" value="{{ $parent->id }}"
                        {{ collect(request('filter_parent'))->contains($parent->id) ? 'checked' : '' }}> {{ $parent->name }}
                </label>
            @endforeach
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-filter"></i> Lọc
        </button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Xóa lọc</a>
    </div>
</form>

    {{-- Nút thêm mới --}}
    <div class="mb-3">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">+ Thêm danh mục</a>
    </div>

    {{-- Bảng danh mục --}}
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Slug</th>
                        <th>Danh mục cha</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($danhMucs as $dm)
                        <tr>
                            <td>{{ $dm->id }}</td>
                            <td>{{ $dm->name }}</td>
                            <td>{{ $dm->slug }}</td>
                            <td>{{ $dm->parent?->name ?? '—' }}</td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $dm->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('admin.categories.destroy', $dm->id) }}" method="POST"
                                    class="d-inline-block"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Phân trang --}}
    <div class="mt-3 d-flex justify-content-center">
        {{ $danhMucs->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>

    <div class="text-muted mb-2 text-center">
        Hiển thị từ {{ $danhMucs->firstItem() }} đến {{ $danhMucs->lastItem() }} trong tổng số {{ $danhMucs->total() }} kết quả
    </div>
@endsection

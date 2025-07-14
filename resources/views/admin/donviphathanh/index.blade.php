@extends('adminlte::page')

@section('title', 'Quản lý Đơn vị phát hành')

@section('content_header')
    <h1>Quản lý Đơn vị phát hành</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.donviphathanh.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Thêm đơn vị phát hành mới
    </a>
    <form method="GET" action="{{ route('admin.donviphathanh.index') }}" class="mb-3">
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

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Hình ảnh</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ds as $dv)
                    <tr>
                        <td>{{ $dv->TenDVPH }}</td>
                        <td>{{ $dv->Email }}</td>
                        <td>{{ $dv->DienThoai }}</td>
                        <td>{{ $dv->DiaChi }}</td>

                        <td>
                            @if ($dv->image)
                                <img src="{{ asset('storage/' . $dv->image) }}" alt="Ảnh" width="60">
                            @else
                                <span class="text-muted">Không có ảnh</span>
                            @endif
                        </td>
                        <td>
                            @if ($dv->trashed())
                                <span class="badge bg-secondary">Đã bị ẩn</span>
                            @else
                                <span class="badge bg-success">Đang hiển thị</span>
                            @endif
                        </td>

                        <td>

                                <a href="{{ route('admin.donviphathanh.edit', $dv->MaDVPH) }}" class="btn btn-sm btn-info">Sửa</a>

                                @if ($dv->trashed())
                                    {{-- Đã bị ẩn → Hiện lại --}}
                                    <form action="{{ route('admin.donviphathanh.restore', $dv->MaDVPH) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Khôi phục đơn vị phát hành này?')">
                                        @csrf
                                        <button class="btn btn-sm btn-success">Hiện lại</button>
                                    </form>
                                @else
                                    {{-- Đang hiển thị → Ẩn --}}
                                    <form action="{{ route('admin.donviphathanh.hide', $dv->MaDVPH) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Ẩn đơn vị phát hành này?')">
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
        <td colspan="6" class="text-muted text-center fst-italic bg-light">
            Một số đơn vị phát hành đã bị ẩn và được hiển thị ở cuối danh sách.
        </td>
    </tr>
@endif
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $ds->appends(request()->all())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}

    </div>

    <div class="text-muted mb-2">
        Hiển thị từ {{ $ds->firstItem() }} đến {{ $ds->lastItem() }} trong tổng số {{ $ds->total() }} kết quả
    </div>
@stop

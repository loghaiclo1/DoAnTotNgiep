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
    <form action="{{ route('admin.donviphathanh.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm theo tên, email, điện thoại, địa chỉ..." value="{{ request('keyword') }}">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i> Tìm</button>
            </div>
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
                            <a href="{{ route('admin.donviphathanh.edit', $dv->MaDVPH) }}" class="btn btn-sm btn-info">Sửa</a>
                            <form action="{{ route('admin.donviphathanh.destroy', $dv->MaDVPH) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Xóa?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
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

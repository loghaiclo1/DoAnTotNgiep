@extends('adminlte::page')

@section('title', 'Phân quyền')

@section('content_header')
    <h1>Phân quyền cho: {{ $user->Ho }} {{ $user->Ten }} ({{ $user->email }})</h1>
    <p class="text-muted">Tích chọn những quyền bạn muốn cấp cho người dùng này. Nhấn <strong>"Lưu quyền"</strong> để cập nhật.</p>
@endsection

@section('content')
    {{-- Thông báo khi lưu thành công --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif

    {{-- Thông báo lỗi --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif

    {{-- Form phân quyền --}}
    <form method="POST" action="{{ route('admin.accounts.permissions.update', $user->MaKhachHang) }}">
        @csrf
        @method('PUT')

        <div class="card shadow-sm mb-3">
            <div class="card-header bg-info text-white">
                <i class="fas fa-user-shield me-1"></i> Danh sách quyền có thể gán
            </div>
            <div class="card-body">
                @if ($permissions->isEmpty())
                    <p class="text-muted">Chưa có quyền nào được tạo trong hệ thống.</p>
                @else
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                           id="perm_{{ $permission->id }}" class="form-check-input"
                                           {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                    <label for="perm_{{ $permission->id }}" class="form-check-label">
                                        {{ ucfirst($permission->name) }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Quay lại
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Lưu quyền
            </button>
        </div>
    </form>

    {{-- Hướng dẫn sử dụng --}}
    <div class="alert alert-info mt-4">
        <h5><i class="fas fa-info-circle me-1"></i> Hướng dẫn</h5>
        <ul class="mb-1">
            <li>Mỗi quyền tương ứng với một chức năng trong hệ thống (VD: thêm sách, xóa sách,...)</li>
            <li>Người dùng chỉ có thể thao tác những chức năng được cấp quyền.</li>
            <li>Nếu bỏ chọn quyền, người dùng sẽ không truy cập được chức năng đó nữa.</li>
            <li>Quyền chỉ có hiệu lực sau khi bạn nhấn <strong>"Lưu quyền"</strong>.</li>
        </ul>
    </div>
    @if (auth()->user()->isSuperAdmin())
    <hr>
    <h4>Thêm quyền mới</h4>
    <form action="{{ route('admin.permissions.store') }}" method="POST" class="mb-4 d-flex" style="gap: 10px;">
        @csrf
        <input type="text" name="name" class="form-control" placeholder="Tên quyền mới (vd: them sach)" required>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>

    <h5>Danh sách quyền hiện có (có thể xóa):</h5>
    <ul class="list-group mb-3">
        @foreach ($permissions as $permission)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $permission->name }}
                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST"
                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa quyền này không?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Xóa</button>
                </form>
            </li>
        @endforeach
    </ul>
@endif
@endsection

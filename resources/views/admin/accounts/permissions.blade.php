@extends('adminlte::page')

@section('title', 'Phân quyền')

@section('content_header')
    <h1>Phân quyền cho: {{ $user->Ho }} {{ $user->Ten }} ({{ $user->email }})</h1>
    <p class="text-muted">Tích chọn những quyền bạn muốn cấp cho người dùng này. Nhấn <strong>"Lưu quyền"</strong> để cập nhật.</p>
@endsection

@section('content')
    {{-- Thông báo --}}
    @foreach (['success', 'error'] as $msg)
        @if (session($msg))
            <div class="alert alert-{{ $msg == 'success' ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
                <i class="fas fa-{{ $msg == 'success' ? 'check' : 'exclamation' }}-circle me-1"></i> {{ session($msg) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif
    @endforeach



    <div class="mb-3">
        <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Quay lại danh sách tài khoản
        </a>
    </div>

    @if (!$user->isSuperAdmin())
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
                        <div class="form-check mb-3">
                            <input type="checkbox" id="selectAll" class="form-check-input">
                            <label for="selectAll" class="form-check-label fw-bold text-primary">
                                Chọn tất cả quyền
                            </label>
                        </div>

                        @php
                            $translatedGroups = [
                                'books' => 'Sách',
                                'categories' => 'Danh mục',
                                'dvph' => 'Đơn vị phát hành',
                                'nxb' => 'Nhà xuất bản',
                                'phieunhaps' => 'Phiếu nhập',
                                'tacgia' => 'Tác giả',
                                'orders' => 'Đơn hàng',
                            ];

                            $grouped = $permissions
                                ->filter(fn($p) => $p->name !== 'full access')
                                ->sortBy('name')
                                ->groupBy(function ($perm) {
                                    $parts = explode(' ', $perm->name);
                                    return $parts[1] ?? 'khác';
                                });
                        @endphp

                        @foreach ($grouped as $group => $groupPermissions)
                            <div class="mb-3 border rounded p-2">
                                <div class="fw-bold text-info mb-2 text-uppercase">
                                    {{ $translatedGroups[$group] ?? ucfirst($group) }}
                                </div>
                                <div class="row">
                                    @foreach ($groupPermissions as $permission)
                                        <div class="col-sm-6 col-md-4 col-lg-2 mb-1">
                                            <div class="form-check" title="{{ $permission->description ?? '' }}">
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                                       id="perm_{{ $permission->id }}" class="form-check-input"
                                                       {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                <label for="perm_{{ $permission->id }}" class="form-check-label">
                                                    {{ config('permissions_vi.' . $permission->name, ucfirst($permission->name)) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('admin.accounts.index') }}" class="btn btn-outline-secondary me-3">
                    <i class="fas fa-arrow-left me-1"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-1"></i> Lưu quyền
                </button>
            </div>
        </form>
    @else
        <div class="alert alert-success">
            <i class="fas fa-crown me-1"></i> Người dùng này là <strong>Super Admin</strong> và có toàn quyền hệ thống mặc định.
        </div>
    @endif
    <div class="alert alert-info">
        <h5><i class="fas fa-info-circle me-1"></i> Hướng dẫn</h5>
        <ul class="mb-1">
            <li>Mỗi quyền tương ứng với một chức năng trong hệ thống (VD: thêm sách, xóa sách,...)</li>
            <li>Người dùng chỉ có thể thao tác những chức năng được cấp quyền.</li>
            <li>Nếu bỏ chọn quyền, người dùng sẽ không truy cập được chức năng đó nữa.</li>
            <li>Quyền chỉ có hiệu lực sau khi bạn nhấn <strong>"Lưu quyền"</strong>.</li>
        </ul>
    </div>
@endsection

@section('css')
    <style>
        .form-check-label {
            font-size: 0.75rem;
        }

        .form-check-input {
            transform: scale(0.75);
            margin-right: 5px;
        }

        .form-check {
            margin-bottom: 2px;
        }
    </style>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('selectAll');
            const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');

            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function () {
                    permissionCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });

                const updateSelectAllState = () => {
                    const allChecked = Array.from(permissionCheckboxes).every(cb => cb.checked);
                    selectAllCheckbox.checked = allChecked;
                };

                permissionCheckboxes.forEach(cb => cb.addEventListener('change', updateSelectAllState));
                updateSelectAllState();
            }
        });
    </script>
@endsection

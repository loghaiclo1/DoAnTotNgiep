@extends('adminlte::page')

@section('title', 'Quản lý Tài khoản')

@section('content_header')
    <h1>Danh sách tài khoản</h1>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


{{-- Form lọc chung --}}
<form method="GET" class="mb-4">
    <div class="row g-2 align-items-center">
        {{-- Tìm theo tên hoặc email --}}
        <div class="col-md-3">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Tìm theo tên hoặc email">
        </div>

        {{-- Lọc theo vai trò --}}
        <div class="col-md-2">
            <select name="role" class="form-select">
                <option value="">-- Vai trò --</option>
                <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="superadmin" {{ request('role') === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
            </select>
        </div>

        {{-- Lọc theo trạng thái --}}
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">-- Trạng thái --</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Bị khóa</option>
            </select>
        </div>

        {{-- Nút Lọc --}}
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-filter"></i> Lọc
            </button>
        </div>

        {{-- Nút Reset --}}
        <div class="col-md-2">
            <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary w-100">
                <i class="fas fa-redo-alt"></i> Reset
            </a>
        </div>
    </div>
</form>


    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Tài khoản người dùng</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-hover m-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Đăng nhập gần nhất</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($accounts as $account)
                    <tr>
                        <td>{{ $account->MaKhachHang }}</td>
                        <td>{{ $account->Ho }} {{ $account->Ten }}</td>
                        <td>{{ $account->email }}</td>
                        <td>
                            <span class="badge bg-{{ $account->role === 'superadmin' ? 'danger' : ($account->role === 'admin' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($account->role) }}
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-{{ $account->TrangThai ? 'success' : 'secondary' }}">
                                {{ $account->TrangThai ? 'Hoạt động' : 'Bị khóa' }}
                            </span>
                        </td>
                        <td>
                            {{ $account->last_login_at ? \Carbon\Carbon::parse($account->last_login_at)->format('d/m/Y H:i') : '—' }}
                        </td>
                        <td>
                            {{ $account->created_at ? \Carbon\Carbon::parse($account->created_at)->format('d/m/Y H:i') : '—' }}
                        </td>
                        <td>
                            <a href="{{ route('admin.accounts.edit', $account->MaKhachHang) }}" class="btn btn-sm btn-outline-primary">Sửa</a>



                            {{-- Nút khóa/mở khóa --}}
                            <form action="{{ route('admin.accounts.toggle', $account->MaKhachHang) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn {{ $account->TrangThai ? 'khóa' : 'mở khóa' }} tài khoản này không?')">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-outline-{{ $account->TrangThai ? 'warning' : 'success' }}">
                                    {{ $account->TrangThai ? 'Khóa' : 'Mở khóa' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Không có tài khoản nào.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
        <div class="text-muted mb-2">
            Hiển thị từ {{ $accounts->firstItem() }} đến {{ $accounts->lastItem() }} trong tổng số {{ $accounts->total() }} kết quả
        </div>
        <div class="card-footer">
            {{ $accounts->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>

    </div>
@endsection

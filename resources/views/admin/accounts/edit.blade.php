@extends('adminlte::page')

@section('title', 'Sửa tài khoản')

@section('content_header')
    <h1>Sửa tài khoản</h1>
@endsection

@section('content')
<form action="{{ route('admin.accounts.update', $account->MaKhachHang) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn cập nhật tài khoản này không?')">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Đã xảy ra lỗi:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="Ho" class="form-label">Họ</label>
            <input type="text" name="Ho" value="{{ old('Ho', $account->Ho) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="Ten" class="form-label">Tên</label>
            <input type="text" name="Ten" value="{{ old('Ten', $account->Ten) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $account->email) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Vai trò</label>
            <select name="role" class="form-select">
                <option value="user" {{ $account->role === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $account->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="superadmin" {{ $account->role === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.admin.accounts') }}" class="btn btn-secondary">Hủy</a>

    </form>
@endsection

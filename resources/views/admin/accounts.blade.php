@extends('adminlte::page')

@section('title', 'Quản lý Tài khoản')

@section('content_header')
    <h1>Danh sách tài khoản</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tài khoản người dùng</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Nguyễn Văn A</td>
                        <td>a@gmail.com</td>
                        <td>Admin</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Sửa</a>
                            <a href="#" class="btn btn-danger btn-sm">Xoá</a>
                        </td>
                    </tr>
                    <!-- Thêm dòng khác nếu cần -->
                </tbody>
            </table>
        </div>
    </div>
@endsection

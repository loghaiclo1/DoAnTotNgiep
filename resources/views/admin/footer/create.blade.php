@extends('adminlte::page')

@section('title', 'Thêm Điều Khoản Footer')

@section('content_header')
    <h1>Thêm Nội Dung </h1>
@stop

@section('content')
    <form action="{{ route('admin.footer.store') }}" method="POST">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Loại dữ liệu --}}
        <div class="form-group">
            <input type="hidden" name="loai_du_lieu" value="muc_con">
        </div>

        {{-- Tên mục --}}
        <div class="form-group">
            <label>Tên mục (ví dụ: Dịch Vụ, Hỗ Trợ,...)</label>
            <input type="text" name="ten_muc" class="form-control" required>
        </div>

        {{-- Tên mục con --}}
        <div class="form-group">
            <label>Tên mục con</label>
            <input type="text" name="ten_muc_con" class="form-control" placeholder="Ví dụ như điều khoản...">
        </div>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Thêm mới</button>
        <a href="{{ route('admin.footer.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@stop

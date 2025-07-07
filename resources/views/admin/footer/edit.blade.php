@extends('adminlte::page')

@section('title', 'Sửa Footer')

@section('content_header')
    <h1>Sửa Footer</h1>
@stop

@section('content')
    <form action="{{ route('admin.footer.update', $footer->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Nếu KHÔNG phải thong_tin_chung => HIỆN Thông tin chung --}}
        @if ($footer->loai_du_lieu !== 'thong_tin_chung')
            <div class="card shadow mb-3">
                <div class="card-header bg-secondary text-white">Thông tin chung</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Loại dữ liệu</label>
                        <input type="text" name="loai_du_lieu" class="form-control" value="{{ $footer->loai_du_lieu }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Tên mục</label>
                        <input type="text" name="ten_muc" class="form-control" value="{{ $footer->ten_muc }}">
                    </div>

                    <div class="form-group">
                        <label>Tên mục con</label>
                        <input type="text" name="ten_muc_con" class="form-control" value="{{ $footer->ten_muc_con }}">
                    </div>

                    <div class="form-group">
                        <label>Đường dẫn</label>
                        <input type="text" name="duong_dan" class="form-control" value="{{ $footer->duong_dan }}">
                        <small class="text-muted">Nếu là link mạng xã hội thì nhập đầy đủ, ví dụ: https://facebook.com/abc</small>
                    </div>

                    <div class="form-group">
                        <label>Nội dung chi tiết</label>
                        <textarea name="noi_dung" class="form-control" rows="8">{{ old('noi_dung', $footer->noi_dung) }}</textarea>
                    </div>
                </div>
            </div>
        @endif

        {{-- Nếu LÀ thong_tin_chung => HIỆN Thông tin công ty --}}
        @if ($footer->loai_du_lieu === 'thong_tin_chung')
            <div class="card shadow mb-3">
                <div class="card-header bg-primary text-white">Thông tin công ty</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên web</label>
                        <input type="text" name="ten_cong_ty" class="form-control" value="{{ $footer->ten_cong_ty }}">
                    </div>

                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" name="dia_chi" class="form-control" value="{{ $footer->dia_chi }}">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $footer->email }}">
                    </div>

                    <div class="form-group">
                        <label>Điện thoại</label>
                        <input type="text" name="dien_thoai" class="form-control" value="{{ $footer->dien_thoai }}">
                    </div>

                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="mo_ta" class="form-control">{{ $footer->mo_ta }}</textarea>
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-2">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
            <a href="{{ route('admin.footer.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
@stop

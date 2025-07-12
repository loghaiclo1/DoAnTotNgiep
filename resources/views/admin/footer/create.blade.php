@extends('adminlte::page')

@section('title', 'Thêm đơn vị phát hành')

@section('content_header')
    <h1>Thêm đơn vị phát hành</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Lỗi!</strong> Vui lòng kiểm tra lại thông tin bên dưới.<br>
        </div>
    @endif

    <form action="{{ route('admin.donviphathanh.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="TenDVPH" class="form-label">Tên đơn vị</label>
            <input type="text" name="TenDVPH" class="form-control @error('TenDVPH') is-invalid @enderror" value="{{ old('TenDVPH') }}" required>
            @error('TenDVPH')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="email" name="Email" class="form-control @error('Email') is-invalid @enderror" value="{{ old('Email') }}">
            @error('Email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="DienThoai" class="form-label">Điện thoại</label>
            <input type="text" name="DienThoai" class="form-control @error('DienThoai') is-invalid @enderror" value="{{ old('DienThoai') }}">
            @error('DienThoai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="DiaChi" class="form-label">Địa chỉ</label>
            <textarea name="DiaChi" class="form-control @error('DiaChi') is-invalid @enderror">{{ old('DiaChi') }}</textarea>
            @error('DiaChi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh (tuỳ chọn)</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">
            <i class="fas fa-save me-1"></i> Lưu
        </button>
        <a href="{{ route('admin.donviphathanh.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('input, textarea, select').forEach(input => {
            input.addEventListener('input', function () {
                if (this.classList.contains('is-invalid')) {
                    this.classList.remove('is-invalid');
                    const errorDiv = this.closest('.mb-3')?.querySelector('.invalid-feedback');
                    if (errorDiv) {
                        errorDiv.remove();
                    }
                }
            });
        });
    });
</script>
@endsection

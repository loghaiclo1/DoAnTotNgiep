@csrf
@if(isset($edit) && $edit)
    @method('PUT')
@endif

<div class="mb-3">
    <label for="TenDVPH" class="form-label">Tên đơn vị</label>
    <input type="text" name="TenDVPH"
           class="form-control @error('TenDVPH') is-invalid @enderror"
           value="{{ old('TenDVPH', $dv->TenDVPH ?? '') }}" required>
    @error('TenDVPH')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="Email" class="form-label">Email</label>
    <input type="email" name="Email"
           class="form-control @error('Email') is-invalid @enderror"
           value="{{ old('Email', $dv->Email ?? '') }}">
    @error('Email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="DienThoai" class="form-label">Điện thoại</label>
    <input type="text" name="DienThoai"
           class="form-control @error('DienThoai') is-invalid @enderror"
           value="{{ old('DienThoai', $dv->DienThoai ?? '') }}">
    @error('DienThoai')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="DiaChi" class="form-label">Địa chỉ</label>
    <textarea name="DiaChi" class="form-control @error('DiaChi') is-invalid @enderror">{{ old('DiaChi', $dv->DiaChi ?? '') }}</textarea>
    @error('DiaChi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="image" class="form-label">Hình ảnh {{ isset($edit) && $edit ? 'mới (nếu cần thay)' : '(tuỳ chọn)' }}</label>
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if (isset($edit) && $edit && $dv->image)
        <p class="mt-2">Hình hiện tại:</p>
        <img src="{{ asset('storage/' . $dv->image) }}" width="100">
    @endif
</div>

<button type="submit" class="btn btn-{{ isset($edit) && $edit ? 'primary' : 'success' }}">
    <i class="fas fa-save me-1"></i> {{ isset($edit) && $edit ? 'Cập nhật' : 'Lưu' }}
</button>
<a href="{{ route('admin.donviphathanh.index') }}" class="btn btn-secondary">Quay lại</a>

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

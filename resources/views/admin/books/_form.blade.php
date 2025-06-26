<div class="form-group">
    <label for="TenSach">Tên sách</label>
    <input type="text" name="TenSach" id="TenSach" class="form-control @error('TenSach') is-invalid @enderror" value="{{ old('TenSach', optional($book)->TenSach) }}" required>
    @error('TenSach')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="GiaNhap">Giá nhập (₫)</label>
    <div class="input-group">
        <input type="number" name="GiaNhap" id="GiaNhap" class="form-control" min="1000" step="1000"
               value="{{ old('GiaNhap', optional($book)->GiaNhap) }}" required>
        <div class="input-group-append">
            <span class="input-group-text">₫</span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="GiaBan">Giá bán (₫)</label>
    <div class="input-group">
        <input type="number" name="GiaBan" id="GiaBan" class="form-control" min="1000" step="1000"
               value="{{ old('GiaBan', optional($book)->GiaBan) }}" required>
        <div class="input-group-append">
            <span class="input-group-text">₫</span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="SoLuong">Số lượng (cuốn)</label>
    <div class="input-group">
        <input type="number" name="SoLuong" id="SoLuong" class="form-control" min="0"
               value="{{ old('SoLuong', optional($book)->SoLuong) }}" required>
        <div class="input-group-append">
            <span class="input-group-text">cuốn</span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="NamXuatBan">Năm xuất bản</label>
    <select name="NamXuatBan" id="NamXuatBan" class="form-control" required>
        @php $yearNow = date('Y'); @endphp
        @foreach(range($yearNow, 2010) as $year)
            <option value="{{ $year }}" {{ old('NamXuatBan', optional($book)->NamXuatBan) == $year ? 'selected' : '' }}>
                {{ $year }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="category_id">Danh mục</label>
    <select name="category_id" id="category_id" class="form-control" required>
        <option value="">-- Chọn danh mục --</option>
        @foreach(\App\Models\Category::all() as $cat)
            <option value="{{ $cat->id }}"
                {{ old('category_id', optional($book)->category_id) == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="MoTa">Mô tả</label>
    <textarea name="MoTa" id="MoTa" class="form-control" rows="4">{{ old('MoTa', optional($book)->MoTa) }}</textarea>
</div>

<div class="form-group">
    <label for="HinhAnh">Hình ảnh (jpg, jpeg, png, webp)</label>
    <input type="file" name="HinhAnh" id="HinhAnh" class="form-control-file @error('HinhAnh') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp" {{ isset($book) ? '' : 'required' }}>
    @error('HinhAnh')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if(isset($book) && $book->HinhAnh)
        <div class="mt-2">
            <img src="{{ asset('image/book/' . $book->HinhAnh) }}" alt="Hình hiện tại" width="100">
        </div>
    @endif
</div>

{{-- resources/views/partials/address-form.blade.php --}}
<div class="form-group mb-3">
    <label for="tinh_thanh_id">Tỉnh/Thành Phố <span class="text-danger">*</span></label>
    <select class="form-select" id="tinh_thanh_id" name="tinh_thanh_id" >
        <option value="">Chọn Tỉnh/Thành Phố</option>
        @foreach ($tinhThanhs as $tinhThanh)
            <option value="{{ $tinhThanh->id }}" {{ old('tinh_thanh_id') == $tinhThanh->id ? 'selected' : '' }}>
                {{ $tinhThanh->ten }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group mb-3">
    <label for="quan_huyen_id">Quận/Huyện <span class="text-danger">*</span></label>
    <select class="form-select" id="quan_huyen_id" name="quan_huyen_id" >
        <option value="">Chọn Quận/Huyện</option>
    </select>
</div>

<div class="form-group mb-3">
    <label for="phuong_xa_id">Phường/Xã <span class="text-danger">*</span></label>
    <select class="form-select" id="phuong_xa_id" name="phuong_xa_id" >
        <option value="">Chọn Phường/Xã</option>
    </select>
</div>

<div class="form-group mb-3">
    <label for="dia_chi_cu_the">Địa chỉ cụ thể <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="dia_chi_cu_the" name="dia_chi_cu_the"
        value="{{ old('dia_chi_cu_the') }}"  placeholder="Số nhà, tên đường">
</div>
<div class="form-group mb-3">
    <label for="so_dien_thoai">Số Điện Thoại <span
            class="text-danger">*</span></label>
            <input type="tel" class="form-control" name="so_dien_thoai"
            id="so_dien_thoai" placeholder="Nhập số điện thoại"
            value="{{ old('so_dien_thoai') }}" pattern="[0-9]{10}"
            title="Vui lòng nhập số điện thoại 10 chữ số">
    <div id="so_dien_thoai_error" class="text-danger"></div>
    @error('so_dien_thoai')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" id="save-address" name="save-address" checked>
    <label class="form-check-label" for="save-address">
        Lưu địa chỉ này cho lần sau
        @if ($isFirst)
            (sẽ là địa chỉ mặc định)
        @endif
    </label>
</div>


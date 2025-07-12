@include('admin.books._form_common', ['book' => null])

<div class="form-group">
    <label for="TenSach">Tên sách</label>
    <input type="text" name="TenSach" id="TenSach" class="form-control @error('TenSach') is-invalid @enderror" value="{{ old('TenSach') }}" required>
    @error('TenSach')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="MaTacGiaAdd">Tác giả</label>
    <div class="input-group">
        <select name="MaTacGia" id="MaTacGiaAdd" class="form-control MaTacGiaSelect" required>
            <option value="">-- Chọn tác giả --</option>
            @foreach($tacgias as $tg)
            <option value="{{ $tg->MaTacGia }}" {{ old('MaTacGia') == $tg->MaTacGia ? 'selected' : '' }}>
                {{ $tg->TenTacGia }} - sinh năm {{ $tg->nam_sinh ?? 'Chưa rõ' }}
            </option>
        @endforeach
        </select>
        <div class="input-group-append">
            <button type="button" class="btn btn-outline-primary btnAddTacGia">Thêm tác giả mới</button>
        </div>
    </div>
</div>

<div class="infoTacGiaBox mb-3" style="display: none;">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="infoNamSinh">Năm sinh</label>
            <input type="text" id="infoNamSinh" class="form-control" readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="infoQueQuan">Quê quán</label>
            <input type="text" id="infoQueQuan" class="form-control" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="infoGhiChu">Ghi chú</label>
        <input type="text" id="infoGhiChu" class="form-control" readonly>
    </div>
</div>



<div class="form-group">
    <label for="MaNXB">Nhà xuất bản</label>
    <select name="MaNXB" id="MaNXB" class="form-control" required>
        <option value="">-- Chọn nhà xuất bản --</option>
        @foreach($nxb as $item)
            <option value="{{ $item->MaNXB }}" {{ old('MaNXB') == $item->MaNXB ? 'selected' : '' }}>
                {{ $item->TenNXB }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="GiaNhap">Giá nhập (₫)</label>
    <div class="input-group">
        <input type="number" name="GiaNhap" id="GiaNhap" class="form-control" min="1000" step="1000"
               value="{{ old('GiaNhap') }}" required>
        <div class="input-group-append">
            <span class="input-group-text">₫</span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="GiaBan">Giá bán (₫)</label>
    <div class="input-group">
        <input type="number" name="GiaBan" id="GiaBan" class="form-control" min="1000" step="1000"
               value="{{ old('GiaBan') }}" required>
        <div class="input-group-append">
            <span class="input-group-text">₫</span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="SoLuong">Số lượng (cuốn)</label>
    <div class="input-group">
        <input type="number" name="SoLuong" id="SoLuong" class="form-control" min="0"
               value="{{ old('SoLuong') }}" required>
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
            <option value="{{ $year }}" {{ old('NamXuatBan') == $year ? 'selected' : '' }}>
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
            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="MoTa">Mô tả</label>
    <textarea name="MoTa" id="MoTa" class="form-control" rows="4">{{ old('MoTa') }}</textarea>
</div>

<div class="form-group">
    <label for="HinhAnh">Hình ảnh (jpg, jpeg, png, webp)</label>
    <input type="file" name="HinhAnh" id="HinhAnh" class="form-control-file @error('HinhAnh') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp" required>
    @error('HinhAnh')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('MaTacGiaAdd');
    const infoBox = document.querySelector('.infoTacGiaBox');
    const infoNam = document.getElementById('infoNamSinh');
    const infoQue = document.getElementById('infoQueQuan');
    const infoChu = document.getElementById('infoGhiChu');

    let currentRequest = null;

    async function loadTacGiaInfo(id) {
        if (!id) {
            infoBox.style.display = 'none';
            infoNam.value = infoQue.value = infoChu.value = '';
            return;
        }

        // Hủy request trước (nếu có)
        if (currentRequest) {
            currentRequest.abort();
        }

        try {
            currentRequest = new AbortController();
            const response = await fetch(`/admin/tacgia/${id}/edit`, {
                signal: currentRequest.signal
            });

            const data = await response.json();

            if (data.success) {
                const tg = data.tacgia;
                infoNam.value = tg.nam_sinh || '';
                infoQue.value = tg.que_quan_text || '';
                infoChu.value = tg.ghi_chu || '';
                infoBox.style.display = 'flex';
            } else {
                infoBox.style.display = 'none';
            }
        } catch (error) {
            // Nếu bị abort hoặc lỗi fetch
            infoBox.style.display = 'none';
        }
    }

    select.addEventListener('change', function () {
        loadTacGiaInfo(this.value);
    });

    // Gọi khi đã có sẵn dữ liệu (reload do lỗi validate)
    if (select.value) {
        loadTacGiaInfo(select.value);
    }
});
</script>
@endpush

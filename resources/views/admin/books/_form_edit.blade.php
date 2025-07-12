@include('admin.books._form_common', ['book' => $book])

<div class="form-group">
    <label for="TenSachEdit{{ $book->MaSach }}">Tên sách</label>
    <input type="text" name="TenSach" id="TenSachEdit{{ $book->MaSach }}"
        class="form-control @error('TenSach') is-invalid @enderror"
        value="{{ old('TenSach', $book->TenSach) }}" required>
    @error('TenSach')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="MaTacGiaEdit{{ $book->MaSach }}">Tác giả</label>
    <div class="input-group">
        <select name="MaTacGia" id="MaTacGiaEdit{{ $book->MaSach }}"
                class="form-control MaTacGiaSelect"
                data-target="infoBox{{ $book->MaSach }}" required>
            <option value="">-- Chọn tác giả --</option>
            @foreach($tacgias as $tg)
                <option value="{{ $tg->MaTacGia }}"
                    {{ old('MaTacGia', $book->MaTacGia) == $tg->MaTacGia ? 'selected' : '' }}>
                    {{ $tg->TenTacGia }}
                </option>
            @endforeach
        </select>
        <div class="input-group-append">
            <button type="button" class="btn btn-outline-primary btnAddTacGia">Thêm tác giả mới</button>
        </div>
    </div>
</div>

<div class="infoTacGiaBox border p-3 mb-3" id="infoBox{{ $book->MaSach }}" style="display: none;">
    <p><strong>Năm sinh:</strong> <span class="infoNamSinh"></span></p>
    <p><strong>Quê quán:</strong> <span class="infoQueQuan"></span></p>
    <p><strong>Ghi chú:</strong> <span class="infoGhiChu"></span></p>
</div>

<div class="form-group">
    <label for="MaNXBEdit{{ $book->MaSach }}">Nhà xuất bản</label>
    <select name="MaNXB" id="MaNXBEdit{{ $book->MaSach }}" class="form-control" required>
        <option value="">-- Chọn nhà xuất bản --</option>
        @foreach($nxb as $item)
            <option value="{{ $item->MaNXB }}"
                {{ old('MaNXB', $book->MaNXB) == $item->MaNXB ? 'selected' : '' }}>
                {{ $item->TenNXB }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="GiaNhapEdit{{ $book->MaSach }}">Giá nhập (₫)</label>
    <input type="number" name="GiaNhap" id="GiaNhapEdit{{ $book->MaSach }}"
        class="form-control" min="1000" step="1000"
        value="{{ old('GiaNhap', $book->GiaNhap) }}" required>
</div>

<div class="form-group">
    <label for="GiaBanEdit{{ $book->MaSach }}">Giá bán (₫)</label>
    <input type="number" name="GiaBan" id="GiaBanEdit{{ $book->MaSach }}"
        class="form-control" min="1000" step="1000"
        value="{{ old('GiaBan', $book->GiaBan) }}" required>
</div>

<div class="form-group">
    <label for="SoLuongEdit{{ $book->MaSach }}">Số lượng</label>
    <input type="number" name="SoLuong" id="SoLuongEdit{{ $book->MaSach }}"
        class="form-control" min="0"
        value="{{ old('SoLuong', $book->SoLuong) }}" required>
</div>

<div class="form-group">
    <label for="NamXuatBanEdit{{ $book->MaSach }}">Năm xuất bản</label>
    <select name="NamXuatBan" id="NamXuatBanEdit{{ $book->MaSach }}" class="form-control" required>
        @php $yearNow = date('Y'); @endphp
        @foreach(range($yearNow, 2010) as $year)
            <option value="{{ $year }}"
                {{ old('NamXuatBan', $book->NamXuatBan) == $year ? 'selected' : '' }}>
                {{ $year }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="category_idEdit{{ $book->MaSach }}">Danh mục</label>
    <select name="category_id" id="category_idEdit{{ $book->MaSach }}" class="form-control" required>
        <option value="">-- Chọn danh mục --</option>
        @foreach(\App\Models\Category::all() as $cat)
            <option value="{{ $cat->id }}"
                {{ old('category_id', $book->category_id) == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="MoTaEdit{{ $book->MaSach }}">Mô tả</label>
    <textarea name="MoTa" id="MoTaEdit{{ $book->MaSach }}" class="form-control" rows="4">{{ old('MoTa', $book->MoTa) }}</textarea>
</div>

<div class="form-group">
    <label for="HinhAnhEdit{{ $book->MaSach }}">Hình ảnh (jpg, jpeg, png, webp)</label>
    <input type="file" name="HinhAnh" id="HinhAnhEdit{{ $book->MaSach }}" class="form-control-file" accept=".jpg,.jpeg,.png,.webp">
    @if($book->HinhAnh)
        <div class="mt-2">
            <img src="{{ asset('image/book/' . $book->HinhAnh) }}" alt="Hình hiện tại" width="100">
        </div>
    @endif
</div>

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selects = document.querySelectorAll('.MaTacGiaSelect');

    selects.forEach(select => {
        const bookId = select.getAttribute('data-target');
        const box = document.getElementById('infoBox' + bookId);
        const infoNam = box.querySelector('.infoNamSinh');
        const infoQue = box.querySelector('.infoQueQuan');
        const infoChu = box.querySelector('.infoGhiChu');

        async function loadTacGiaInfo(id) {
            if (!id) {
                box.style.display = 'none';
                infoNam.textContent = infoQue.textContent = infoChu.textContent = '';
                return;
            }

            try {
                const res = await fetch(`/admin/tacgia/${id}/edit`);
                const data = await res.json();

                if (data.success) {
                    const tg = data.tacgia;
                    infoNam.textContent = tg.nam_sinh || '';
                    infoQue.textContent = tg.que_quan_text || '';
                    infoChu.textContent = tg.ghi_chu || '';
                    box.style.display = 'block';
                } else {
                    box.style.display = 'none';
                }
            } catch (e) {
                box.style.display = 'none';
            }
        }

        // Gọi khi đổi tác giả
        select.addEventListener('change', () => loadTacGiaInfo(select.value));

        // Gọi nếu có sẵn giá trị khi mở modal
        if (select.value) {
            loadTacGiaInfo(select.value);
        }
    });
});
</script>
@endpush

<div class="form-group">
    <label for="TenSachEdit{{ $book->MaSach }}">Tên sách</label>
    <input type="text" name="TenSach" id="TenSachEdit{{ $book->MaSach }}"
        class="form-control @error('TenSach') is-invalid @enderror" value="{{ old('TenSach', $book->TenSach) }}" required>
    @error('TenSach')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="MaTacGiaEdit{{ $book->MaSach }}">Tác giả</label>
    <div class="input-group">
        <select name="MaTacGia" id="MaTacGiaEdit{{ $book->MaSach }}" class="form-control MaTacGiaSelect"
            data-target="{{ $book->MaSach }}" required>
            <option value="">-- Chọn tác giả --</option>
            @foreach ($tacgias as $tg)
                <option value="{{ $tg->MaTacGia }}"
                    {{ old('MaTacGia', $book->MaTacGia) == $tg->MaTacGia ? 'selected' : '' }}>
                    {{ $tg->TenTacGia }} - sinh năm {{ $tg->nam_sinh ?? 'Chưa rõ' }}
                </option>
            @endforeach
        </select>
        <div class="input-group-append">
            <button type="button" class="btn btn-outline-primary btnAddTacGia">Thêm tác giả mới</button>
        </div>
    </div>
</div>

<div class="infoTacGiaBox mb-3" id="infoBox{{ $book->MaSach }}">
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="infoNamSinh{{ $book->MaSach }}">Năm sinh</label>
            <input type="text" id="infoNamSinh{{ $book->MaSach }}" class="form-control" readonly>
        </div>
        <div class="form-group col-md-2">
            <label for="infoGioiTinh{{ $book->MaSach }}">Giới tính</label>
            <input type="text" id="infoGioiTinh{{ $book->MaSach }}" class="form-control" readonly>
        </div>
        <div class="form-group col-md-8">
            <label for="infoQueQuan{{ $book->MaSach }}">Quê quán</label>
            <input type="text" id="infoQueQuan{{ $book->MaSach }}" class="form-control" readonly>
        </div>
    </div>

    <div class="form-group">
        <label for="infoGhiChu{{ $book->MaSach }}">Ghi chú</label>
        <input type="text" id="infoGhiChu{{ $book->MaSach }}" class="form-control" readonly>
    </div>
</div>

<div class="form-group">
    <label for="MaNXBEdit{{ $book->MaSach }}">Nhà xuất bản</label>
    <select name="MaNXB" id="MaNXBEdit{{ $book->MaSach }}" class="form-control" required>
        <option value="">-- Chọn nhà xuất bản --</option>
        @foreach ($nxb as $item)
            <option value="{{ $item->MaNXB }}" {{ old('MaNXB', $book->MaNXB) == $item->MaNXB ? 'selected' : '' }}>
                {{ $item->TenNXB }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="DonViPhatHanhEdit{{ $book->MaSach }}">Đơn vị phát hành</label>
    <select name="MaDVPH" id="MaDVPH" class="form-control">
        <option value="">-- Không có đơn vị phát hành --</option>
        @foreach ($donviphathanh as $dvph)
            <option value="{{ $dvph->MaDVPH }}"
                {{ old('MaDVPH', $book->MaDVPH ?? '') == $dvph->MaDVPH ? 'selected' : '' }}>
                {{ $dvph->TenDVPH }}
            </option>
        @endforeach
    </select>
    <small class="form-text text-muted">Bạn có thể chọn 1 đơn vị phát hành hoặc không chọn cái nào.</small>
</div>


<div class="form-group">
    <label for="GiaNhapEdit{{ $book->MaSach }}">Giá nhập (₫)</label>
    <div class="input-group">
        <input type="number" name="GiaNhap" id="GiaNhapEdit{{ $book->MaSach }}" class="form-control" min="1000"
            step="1000" value="{{ old('GiaNhap', $book->GiaNhap) }}" required>
        <div class="input-group-append">
            <span class="input-group-text">₫</span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="GiaBanEdit{{ $book->MaSach }}">Giá bán (₫)</label>
    <div class="input-group">
        <input type="number" name="GiaBan" id="GiaBanEdit{{ $book->MaSach }}" class="form-control" min="1000"
            step="1000" value="{{ old('GiaBan', $book->GiaBan) }}" required>
        <div class="input-group-append">
            <span class="input-group-text">₫</span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="SoLuongEdit{{ $book->MaSach }}">Số lượng (cuốn)</label>
    <div class="input-group">
        <input type="number" name="SoLuong" id="SoLuongEdit{{ $book->MaSach }}" class="form-control" min="0"
            value="{{ old('SoLuong', $book->SoLuong) }}" required>
        <div class="input-group-append">
            <span class="input-group-text">cuốn</span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="NamXuatBanEdit{{ $book->MaSach }}">Năm xuất bản</label>
    <select name="NamXuatBan" id="NamXuatBanEdit{{ $book->MaSach }}" class="form-control" required>
        @php $yearNow = date('Y'); @endphp
        @foreach (range($yearNow, 2010) as $year)
            <option value="{{ $year }}" {{ old('NamXuatBan', $book->NamXuatBan) == $year ? 'selected' : '' }}>
                {{ $year }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="category_idEdit{{ $book->MaSach }}">Danh mục</label>
    <select name="category_id" id="category_idEdit{{ $book->MaSach }}" class="form-control" required>
        <option value="">-- Chọn danh mục --</option>
        @foreach (\App\Models\Category::all() as $cat)
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
    <input type="file" name="HinhAnh" id="HinhAnhEdit{{ $book->MaSach }}" class="form-control-file"
        accept=".jpg,.jpeg,.png,.webp">
    @if ($book->HinhAnh)
        <div class="mt-2">
            <img src="{{ asset('image/book/' . $book->HinhAnh) }}" alt="Hình hiện tại" width="100">
        </div>
    @endif
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('.MaTacGiaSelect');

            selects.forEach(select => {
                const bookId = select.getAttribute('data-target');

                const infoBox = document.getElementById('infoBox' + bookId);
                const infoSex = document.getElementById('infoGioiTinh' + bookId);
                const infoNam = document.getElementById('infoNamSinh' + bookId);
                const infoQue = document.getElementById('infoQueQuan' + bookId);
                const infoChu = document.getElementById('infoGhiChu' + bookId);

                let currentRequest = null; // Dùng để hủy request cũ nếu đang gọi

                async function loadTacGiaInfo(id) {
                    if (!id) {
                        infoBox.style.display = 'none';
                        infoNam.value = infoQue.value = infoChu.value = '';
                        return;
                    }

                    // Hủy request cũ nếu đang chờ
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
                            infoSex.value = tg.gioi_tinh;
                            infoQue.value = tg.que_quan_text || '';
                            infoChu.value = tg.ghi_chu || '';
                            infoBox.style.display = 'block';
                        } else {
                            infoBox.style.display = 'none';
                        }
                    } catch (error) {
                        infoBox.style.display = 'none';
                    }
                }

                // Khi người dùng thay đổi dropdown
                select.addEventListener('change', function() {
                    loadTacGiaInfo(this.value);
                });

                // GỌI THỦ CÔNG khi mở modal chứa select này
                const modal = select.closest('.modal');
                if (modal) {
                    $(modal).on('shown.bs.modal', function() {
                        if (select.value) {
                            loadTacGiaInfo(select.value);
                        }
                    });
                }
            });
        });
    </script>
@endpush

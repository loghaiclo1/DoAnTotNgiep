@extends('adminlte::page')

@section('title', 'Sửa Phiếu Nhập')

@section('content_header')
    <h1>Sửa Phiếu Nhập #{{ $phieuNhap->MaPhieuNhap }}</h1>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger">{{ implode(', ', $errors->all()) }}</div>
@endif

<form method="POST" action="{{ route('admin.phieunhap.update', $phieuNhap->MaPhieuNhap) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="GhiChu">Ghi chú</label>
        <textarea name="GhiChu" id="GhiChu" class="form-control" rows="2">{{ old('GhiChu', $phieuNhap->GhiChu) }}</textarea>
    </div>

    <h5>Chi tiết phiếu nhập:</h5>

    {{-- Nút khôi phục dòng đã xóa --}}
    <div id="undo-container" style="margin-bottom:10px; display:none;">
        <button type="button" class="btn btn-warning btn-sm" onclick="undoDelete()">Khôi phục dòng đã xóa</button>
    </div>

    <table class="table table-bordered" id="books-table">
        <thead>
            <tr>
                <th>Sách</th>
                <th>Số lượng</th>
                <th>Giá nhập</th>
                <th>Giá bán</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($phieuNhap->chi_tiet as $i => $item)
                <tr>
                    <td>
                        <select name="books[{{ $i }}][MaSach]" class="form-control select-book" required onchange="updateGiaCu(this)">
                            <option value="">-- Chọn sách --</option>
                            @foreach($books as $book)
                                <option value="{{ $book->MaSach }}"
                                    data-gianhap="{{ $book->GiaNhap ?? 0 }}"
                                    data-giaban="{{ $book->GiaBan ?? 0 }}"
                                    data-tacgia="{{ $book->tacgia->TenTacGia ?? 'Không rõ' }}"
                                    data-nxb="{{ $book->nhaxuatban->TenNXB ?? 'Không rõ' }}"
                                    {{ $item->MaSach == $book->MaSach ? 'selected' : '' }}>
                                    {{ $book->TenSach }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted gia-cu">
                            Giá nhập hiện tại: <span class="gia-nhap-cu">{{ number_format($item->sach->GiaNhap ?? 0) }}₫</span>,
                            Giá bán hiện tại: <span class="gia-ban-cu">{{ number_format($item->sach->GiaBan ?? 0) }}₫</span>
                        </small>
                        <small class="text-muted tacgia-nxb">
                            Tác giả: <span class="tac-gia">{{ $item->sach->tacgia->TenTacGia ?? '-' }}</span>,
                            NXB: <span class="nxb">{{ $item->sach->nhaxuatban->TenNXB ?? '-' }}</span>
                        </small>
                    </td>
                    <td><input type="number" name="books[{{ $i }}][SoLuong]" class="form-control" value="{{ $item->SoLuong }}" min="1" required></td>
                    <td><input type="number" name="books[{{ $i }}][DonGia]" class="form-control" value="{{ $item->DonGia }}" min="1000"></td>
                    <td><input type="number" name="books[{{ $i }}][GiaBan]" class="form-control" value="{{ $item->sach->GiaBan }}" min="1000"></td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">×</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button class="btn btn-primary">Cập nhật Phiếu Nhập</button>
</form>

<template id="book-row-template">
    <tr>
        <td>
            <select name="__name__" class="form-control select-book" required onchange="updateGiaCu(this)">
                <option value="">-- Chọn sách --</option>
                @foreach($books as $book)
                <option value="{{ $book->MaSach }}"
                    data-gianhap="{{ $book->GiaNhap ?? 0 }}"
                    data-giaban="{{ $book->GiaBan ?? 0 }}"
                    data-tacgia="{{ $book->tacgia->TenTacGia ?? 'Không rõ' }}"
                    data-nxb="{{ $book->nhaxuatban->TenNXB ?? 'Không rõ' }}">
                    {{ $book->TenSach }}
                </option>
                @endforeach
            </select>
            <small class="text-muted gia-cu">
                Giá nhập hiện tại: <span class="gia-nhap-cu">-</span>,
                Giá bán hiện tại: <span class="gia-ban-cu">-</span>
            </small>
            <small class="text-muted tacgia-nxb">
                Tác giả: <span class="tac-gia">-</span>,
                NXB: <span class="nxb">-</span>
            </small>
        </td>
        <td><input type="number" name="__soluong__" class="form-control" min="1" required></td>
        <td><input type="number" name="__dongia__" class="form-control" min="1000"></td>
        <td><input type="number" name="__giaban__" class="form-control" min="1000"></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">×</button></td>
    </tr>
</template>
@stop

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .gia-cu { font-size: 12px; display: block; margin-top: 5px; }
    .select2-container--default .select2-selection--single {
        height: 38px; padding: 6px 12px; font-size: 14px;
    }
    .select2-container { width: 100% !important; }
</style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    let index = {{ count($phieuNhap->chi_tiet) }};
    let deletedRows = [];

    function addRow() {
        const template = document.getElementById('book-row-template');
        const clone = template.content.cloneNode(true);

        clone.querySelectorAll('select, input').forEach(el => {
            if (el.name?.includes('__name__')) el.name = `books[${index}][MaSach]`;
            if (el.name?.includes('__soluong__')) el.name = `books[${index}][SoLuong]`;
            if (el.name?.includes('__dongia__')) el.name = `books[${index}][DonGia]`;
            if (el.name?.includes('__giaban__')) el.name = `books[${index}][GiaBan]`;
        });

        document.querySelector('#books-table tbody').appendChild(clone);
        $('.select-book').select2();
        index++;
        refreshBookOptions();
    }

    function removeRow(btn) {
    if (confirm('Bạn có chắc chắn muốn xóa dòng sách này?')) {
        const row = btn.closest('tr');
        const select = row.querySelector('select');
        const maSach = select.value;
        const soLuong = row.querySelector('input[name*="[SoLuong]"]').value;
        const donGia = row.querySelector('input[name*="[DonGia]"]').value;
        const giaBan = row.querySelector('input[name*="[GiaBan]"]').value;

        deletedRows.push({ maSach, soLuong, donGia, giaBan });

        row.remove();
        refreshBookOptions();
        showUndoButton();
    }
}
    function showUndoButton() {
        const undoContainer = document.getElementById('undo-container');
        if (deletedRows.length > 0) {
            undoContainer.style.display = 'block';
        } else {
            undoContainer.style.display = 'none';
        }
    }

    function undoDelete() {
    const tbody = document.querySelector('#books-table tbody');

    deletedRows.forEach(data => {
        const template = document.getElementById('book-row-template');
        const clone = template.content.cloneNode(true);

        // Set name với index mới
        clone.querySelectorAll('select, input').forEach(el => {
            if (el.name?.includes('__name__')) el.name = `books[${index}][MaSach]`;
            if (el.name?.includes('__soluong__')) el.name = `books[${index}][SoLuong]`;
            if (el.name?.includes('__dongia__')) el.name = `books[${index}][DonGia]`;
            if (el.name?.includes('__giaban__')) el.name = `books[${index}][GiaBan]`;
        });

        // Gán lại dữ liệu vào dòng mới
        const newRow = clone.querySelector('tr');
        newRow.querySelector(`select[name="books[${index}][MaSach]"]`).value = data.maSach;
        newRow.querySelector(`input[name="books[${index}][SoLuong]"]`).value = data.soLuong;
        newRow.querySelector(`input[name="books[${index}][DonGia]"]`).value = data.donGia;
        newRow.querySelector(`input[name="books[${index}][GiaBan]"]`).value = data.giaBan;

        tbody.appendChild(clone);
        index++;
    });

    $('.select-book').select2();
    refreshBookOptions();
    deletedRows = [];
    showUndoButton();
}

    function updateGiaCu(selectEl) {
        const selectedOption = selectEl.options[selectEl.selectedIndex];
        const giaNhap = selectedOption.getAttribute('data-gianhap') || 0;
        const giaBan = selectedOption.getAttribute('data-giaban') || 0;
        const tacGia = selectedOption.getAttribute('data-tacgia') || '-';
        const nxb = selectedOption.getAttribute('data-nxb') || '-';
        const row = selectEl.closest('tr');

        row.querySelector('.gia-nhap-cu').textContent = Number(giaNhap).toLocaleString() + '₫';
        row.querySelector('.gia-ban-cu').textContent = Number(giaBan).toLocaleString() + '₫';
        row.querySelector('.tac-gia').textContent = tacGia;
        row.querySelector('.nxb').textContent = nxb;
        row.querySelector('input[name*="[DonGia]"]').value = giaNhap;
        row.querySelector('input[name*="[GiaBan]"]').value = giaBan;

        refreshBookOptions();
    }

    function refreshBookOptions() {
        const selectedValues = Array.from(document.querySelectorAll('.select-book'))
            .map(s => s.value)
            .filter(Boolean);
        document.querySelectorAll('.select-book').forEach(select => {
            const currentValue = select.value;
            Array.from(select.options).forEach(option => {
                if (!option.value) return;
                option.disabled = (option.value !== currentValue && selectedValues.includes(option.value));
            });
        });
        $('.select-book').select2();
    }

    document.addEventListener('DOMContentLoaded', () => {
        $('.select-book').select2();
        refreshBookOptions();

        // Xác nhận khi submit form
        const form = document.querySelector('form[action="{{ route('admin.phieunhap.update', $phieuNhap->MaPhieuNhap) }}"]');
        if (form) {
            form.addEventListener('submit', function (e) {
                const rowCount = document.querySelectorAll('#books-table tbody tr').length;
                if (rowCount === 0) {
                    if (!confirm('Bạn đã xóa tất cả sách trong phiếu. Bạn có chắc muốn cập nhật phiếu nhập mà không có sách nào?')) {
                        e.preventDefault();
                    }
                }
            });
        }
    });
</script>
@endpush

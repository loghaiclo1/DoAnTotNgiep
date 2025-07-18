@extends('adminlte::page')

@section('title', 'Tạo Phiếu Nhập')

@section('content_header')
    <h1>Nhập Sách Vào Kho</h1>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger">{{ implode(', ', $errors->all()) }}</div>
@endif


<div class="alert alert-info">
    <strong>Lưu ý:</strong> Khi bạn chọn sách, hệ thống sẽ tự động điền giá nhập và giá bán hiện tại vào ô tương ứng.
    Bạn có thể chỉnh sửa nếu muốn cập nhật giá mới.
</div>

<form method="POST" action="{{ route('admin.phieunhap.store') }}">
    @csrf
    <div class="form-group">
        <label for="GhiChu">Ghi chú</label>
        <textarea name="GhiChu" id="GhiChu" class="form-control" rows="2"></textarea>
    </div>

    <h5>Chi tiết phiếu nhập:</h5>
    <table class="table table-bordered" id="books-table">
        <thead>
            <tr>
                <th>Sách</th>
                <th>Số lượng</th>
                <th>Giá nhập</th>
                <th>Giá bán</th>
                <th><button type="button" class="btn btn-success btn-sm" onclick="addRow()">+</button></th>
            </tr>
        </thead>
        <tbody>
            <!-- Dòng đầu tiên mặc định -->
            <tr>
                <td>
                    <select name="books[0][MaSach]" class="form-control select-book" required onchange="updateGiaCu(this)">
                        <option value="">-- Chọn sách --</option>
                        @foreach($books as $book)
                        <option value="{{ $book->MaSach }}"
                            data-gianhap="{{ $book->GiaNhap ?? 0 }}"
                            data-giaban="{{ $book->GiaBan ?? 0 }}"
                            data-tacgia="{{ $book->tacgia->TenTacGia ?? 'Không rõ' }}"
                            data-nxb="{{ $book->nhaxuatban->TenNXB ?? 'Không rõ' }}"
                            data-dvph="{{ $book->donviphathanh->TenDVPH ?? 'Không rõ' }}">
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
                        NXB: <span class="nxb">-</span>,
                        ĐVPH: <span class="ten-dvph">-</span>
                    </small>
                </td>
                <td><input type="number" name="books[0][SoLuong]" class="form-control" min="1" required></td>
                <td><input type="number" name="books[0][DonGia]" class="form-control" min="1000"></td>
                <td><input type="number" name="books[0][GiaBan]" class="form-control" min="1000"></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <button class="btn btn-primary">Lưu phiếu nhập</button>
</form>

<!-- Template cho dòng mới -->
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
                    data-nxb="{{ $book->nhaxuatban->TenNXB ?? 'Không rõ' }}"
                    data-dvph="{{ $book->donviphathanh->TenDVPH ?? 'Không rõ' }}">
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
                NXB: <span class="nxb">-</span>,
                ĐVPH: <span class="ten-dvph">-</span>
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
    .gia-cu {
        font-size: 12px;
        display: block;
        margin-top: 5px;
    }
    .select2-container--default .select2-selection--single {
        height: 38px;
        padding: 6px 12px;
        font-size: 14px;
    }
    .select2-container {
        width: 100% !important;
    }
</style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    let index = 1;

    function addRow() {
        const template = document.getElementById('book-row-template');
        const clone = template.content.cloneNode(true);

        // Cập nhật name
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
        btn.closest('tr').remove();
        refreshBookOptions();
    }

    function updateGiaCu(selectEl) {
    const selectedOption = selectEl.options[selectEl.selectedIndex];
    const giaNhap = selectedOption.getAttribute('data-gianhap') || 0;
    const giaBan = selectedOption.getAttribute('data-giaban') || 0;
    const tacGia = selectedOption.getAttribute('data-tacgia') || '-';
    const nxb = selectedOption.getAttribute('data-nxb') || '-';
    const dvph = selectedOption.getAttribute('data-dvph') || '-'; //

    const row = selectEl.closest('tr');
    row.querySelector('.gia-nhap-cu').textContent = Number(giaNhap).toLocaleString() + '₫';
    row.querySelector('.gia-ban-cu').textContent = Number(giaBan).toLocaleString() + '₫';
    row.querySelector('.tac-gia').textContent = tacGia;
    row.querySelector('.nxb').textContent = nxb;
    row.querySelector('.ten-dvph').textContent = dvph; //

    row.querySelector('input[name*="[DonGia]"]').value = giaNhap;
    row.querySelector('input[name*="[GiaBan]"]').value = giaBan;

    refreshBookOptions();
}

    function refreshBookOptions() {
        const selectedValues = Array.from(document.querySelectorAll('.select-book'))
            .map(select => select.value)
            .filter(val => val); // loại bỏ rỗng

        document.querySelectorAll('.select-book').forEach(select => {
            const currentValue = select.value;
            Array.from(select.options).forEach(option => {
                if (!option.value) return; // bỏ option mặc định
                if (option.value !== currentValue && selectedValues.includes(option.value)) {
                    option.disabled = true;
                } else {
                    option.disabled = false;
                }
            });
        });

        $('.select-book').select2(); 
    }

    document.addEventListener('DOMContentLoaded', function () {
        $('.select-book').select2();

        document.querySelector('form').addEventListener('submit', function () {
            const rows = document.querySelectorAll('#books-table tbody tr');
            rows.forEach(row => {
                const select = row.querySelector('select.select-book');
                const selectedOption = select.options[select.selectedIndex];

                const giaNhapCu = selectedOption.getAttribute('data-gianhap') || 0;
                const giaBanCu = selectedOption.getAttribute('data-giaban') || 0;

                const inputDonGia = row.querySelector('input[name*="[DonGia]"]');
                const inputGiaBan = row.querySelector('input[name*="[GiaBan]"]');

                if (!inputDonGia.value) inputDonGia.value = giaNhapCu;
                if (!inputGiaBan.value) inputGiaBan.value = giaBanCu;
            });
        });

    });

</script>

@endpush

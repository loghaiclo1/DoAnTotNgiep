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
                <th>Đơn giá</th>
                <th><button type="button" class="btn btn-success btn-sm" onclick="addRow()">+</button></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select name="books[0][MaSach]" class="form-control" required>
                        <option value="">-- Chọn sách --</option>
                        @foreach($books as $book)
                            <option value="{{ $book->MaSach }}">{{ $book->TenSach }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="books[0][SoLuong]" class="form-control" min="1" required></td>
                <td><input type="number" name="books[0][DonGia]" class="form-control" min="1000" required></td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">×</button></td>
            </tr>
        </tbody>
    </table>

    <button class="btn btn-primary">Lưu phiếu nhập</button>
</form>
@stop

@push('js')
<script>
    let index = 1;
    function addRow() {
        const row = `
            <tr>
                <td>
                    <select name="books[${index}][MaSach]" class="form-control" required>
                        <option value="">-- Chọn sách --</option>
                        @foreach($books as $book)
                            <option value="{{ $book->MaSach }}">{{ $book->TenSach }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="books[${index}][SoLuong]" class="form-control" min="1" required></td>
                <td><input type="number" name="books[${index}][DonGia]" class="form-control" min="1000" required></td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">×</button></td>
            </tr>
        `;
        document.querySelector('#books-table tbody').insertAdjacentHTML('beforeend', row);
        index++;
    }

    function removeRow(btn) {
        btn.closest('tr').remove();
    }
</script>
@endpush

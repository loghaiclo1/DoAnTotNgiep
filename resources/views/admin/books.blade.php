@extends('adminlte::page')

@section('title', 'Quản lý Sách')

@section('content_header')
    <h1>Quản lý Sách</h1>
@stop

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Đã có lỗi xảy ra!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    {{-- Hiển thị thông báo --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="GET" action="{{ route('admin.books.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" value="{{ request('query') }}" class="form-control"
                   placeholder="🔍 Nhập tên sách hoặc mô tả..." aria-label="Tìm kiếm sách">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i> Tìm
                </button>
            </div>
        </div>
    </form>
    <button class="btn btn-info mb-3" type="button" data-toggle="collapse" data-target="#filterBox">
        🔽 Bộ lọc
    </button>
    <form id="filterBox" method="GET" action="{{ route('admin.books.index') }}" class="collapse filter-wrapper mb-4 p-3 bg-dark text-white rounded">

        <h5 class="mb-3">Lọc sách</h5>

        {{-- Thể loại / Danh mục --}}
        <div class="mb-3">
            <label class="fw-bold">Danh mục:</label><br>
            @foreach($categories as $cat)
                <label class="btn btn-sm btn-outline-light m-1 {{ collect(request('category_id'))->contains($cat->id) ? 'active' : '' }}">
                    <input type="checkbox" name="category_id[]" value="{{ $cat->id }}" class="d-none"
                        {{ collect(request('category_id'))->contains($cat->id) ? 'checked' : '' }}>
                    {{ $cat->name }}
                </label>
            @endforeach
        </div>

        {{-- Năm xuất bản --}}
        <div class="mb-3">
            <label class="fw-bold">Năm xuất bản:</label><br>
            @php
                $years = range(date('Y'), 2010);
            @endphp
            @foreach($years as $year)
                <label class="btn btn-sm btn-outline-light m-1 {{ collect(request('NamXuatBan'))->contains($year) ? 'active' : '' }}">
                    <input type="checkbox" name="NamXuatBan[]" value="{{ $year }}" class="d-none"
                        {{ collect(request('NamXuatBan'))->contains($year) ? 'checked' : '' }}>
                    {{ $year }}
                </label>
            @endforeach
        </div>

        {{-- Trạng thái --}}
        <div class="mb-3">
            <label class="fw-bold">Trạng thái:</label><br>
            @php
                $statuses = [
                    1 => 'Còn hàng',
                    0 => 'Hết hàng'
                ];
            @endphp
            @foreach($statuses as $val => $label)
                <label class="btn btn-sm btn-outline-light m-1 {{ collect(request('TrangThai'))->contains($val) ? 'active' : '' }}">
                    <input type="checkbox" name="TrangThai[]" value="{{ $val }}" class="d-none"
                        {{ collect(request('TrangThai'))->contains($val) ? 'checked' : '' }}>
                    {{ $label }}
                </label>
            @endforeach
        </div>

        {{-- Sắp xếp & Thứ tự --}}
        <div class="row align-items-center mb-3">
            <div class="col-md-5">
                <select name="sort" class="form-control">
                    <option value="id" {{ request('sort') == 'MaSach' ? 'selected' : '' }}>Sách mới nhất</option>
                    <option value="GiaBan" {{ request('sort') == 'GiaBan' ? 'selected' : '' }}>Giá bán</option>
                    <option value="SoLuong" {{ request('sort') == 'SoLuong' ? 'selected' : '' }}>Số lượng</option>
                    <option value="LuotMua" {{ request('sort') == 'LuotMua' ? 'selected' : '' }}>Lượt mua</option>
                    <option value="NamXuatBan" {{ request('sort') == 'NamXuatBan' ? 'selected' : '' }}>Năm xuất bản</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="direction" class="form-control">
                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>↑ Tăng dần</option>
                    <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>↓ Giảm dần</option>
                </select>
            </div>
            <div class="col-md-4 d-flex">
                <button type="submit" class="btn btn-danger w-100 me-2"><i class="fas fa-filter"></i> Lọc</button>
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary w-100">Xóa lọc</a>
            </div>
        </div>
    </form>



    {{-- Nút thêm --}}
    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalAdd">+ Thêm sách</button>

    {{-- Bảng danh sách sách --}}
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Mã</th>
                <th>Ảnh</th>
                <th>Tên sách</th>
                <th>Giá nhập</th>
                <th>Giá bán</th>
                <th>Số lượng</th>
                <th>Năm xuất bản</th>
                <th>Lượt mua</th>
                <th>Danh mục</th>
                <th>Ngày thêm</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{ $book->MaSach }}</td>
            <td><img src="{{ asset('image/book/' . $book->HinhAnh) }}" width="50"></td>
            <td>{{ $book->TenSach }}</td>
            <td>{{ number_format($book->GiaNhap) }}₫</td>
            <td>{{ number_format($book->GiaBan) }}₫</td>
            <td>{{ $book->SoLuong }}</td>
            <td>{{ $book->NamXuatBan }}</td>
            <td>{{ $book->LuotMua }}</td>
            <td>{{ $book->category->name ?? 'Không có' }}</td>
            <td>{{ $book->created_at->format('d/m/Y H:i') }}</td>
            <td>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEdit{{ $book->MaSach }}">Sửa</button>
                <form action="{{ route('admin.books.destroy', $book->MaSach) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Xác nhận xóa?')" class="btn btn-sm btn-danger">Xóa</button>
                </form>
            </td>
        </tr>

            {{-- Modal sửa --}}
            <div class="modal fade" id="modalEdit{{ $book->MaSach }}">
                <div class="modal-dialog modal-lg">
                    <form method="POST" action="{{ route('admin.books.update', $book->MaSach) }}" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Sửa sách: {{ $book->TenSach }}</h5>
                                <button class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                @include('admin.books._form', ['book' => $book])
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Cập nhật</button>
                                <button class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>

    <div class="mt-3 d-flex justify-content-center">
        {{ $books->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>

    <div class="text-muted mb-2">
        Hiển thị từ {{ $books->firstItem() }} đến {{ $books->lastItem() }} trong tổng số {{ $books->total() }} kết quả
    </div>


    {{-- Modal thêm --}}
    <div class="modal fade" id="modalAdd">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm sách mới</h5>
                        <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        @include('admin.books._form', ['book' => null])
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success">Lưu</button>
                        <button class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop
@push('js')
<script>
    // Toggle class active thủ công khi chọn checkbox
    document.querySelectorAll('.filter-wrapper input[type="checkbox"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                this.parentElement.classList.add('active');
            } else {
                this.parentElement.classList.remove('active');
            }
        });
    });
</script>
@endpush
@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush

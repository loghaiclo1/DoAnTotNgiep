@extends('adminlte::page')

@section('title', 'Quản lý Sách')

@section('content_header')
    <h1>Quản lý Sách</h1>
@stop

@section('content')

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
    @if (session('success'))
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
    <form id="filterBox" method="GET" action="{{ route('admin.books.index') }}"
        class="collapse filter-wrapper mb-4 p-3 bg-dark text-white rounded">

        <h5 class="mb-3">Lọc sách</h5>

        {{-- Thể loại / Danh mục --}}
        <div class="mb-3">
            <label class="fw-bold">Danh mục:</label><br>
            @foreach ($categories as $cat)
                <label
                    class="btn btn-sm btn-outline-light m-1 {{ collect(request('category_id'))->contains($cat->id) ? 'active' : '' }}">
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
            @foreach ($years as $year)
                <label
                    class="btn btn-sm btn-outline-light m-1 {{ collect(request('NamXuatBan'))->contains($year) ? 'active' : '' }}">
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
                    'in_stock' => 'Còn hàng',
                    'out_of_stock' => 'Hết hàng',
                    'active' => 'Đang hiển thị',
                    'hidden' => 'Đã ẩn',
                ];
            @endphp
            @foreach ($statuses as $val => $label)
                <label
                    class="btn btn-sm btn-outline-light m-1 {{ collect(request('TrangThai'))->contains($val) ? 'active' : '' }}">
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
                    <option value="NamXuatBan" {{ request('sort') == 'NamXuatBan' ? 'selected' : '' }}>Năm xuất bản
                    </option>
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
                <th>Tác giả</th>
                <th>NXB</th>
                <th>Đơn vị phát hành</th>
                <th>Giá nhập</th>
                <th>Giá bán</th>
                <th>Số lượng</th>
                <th>Năm xuất bản</th>
                <th>Lượt mua</th>
                <th>Danh mục</th>
                <th>Ngày thêm</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->MaSach }}</td>
                    <td><img src="{{ asset('image/book/' . $book->HinhAnh) }}" width="50"></td>
                    <td>{{ $book->TenSach }}</td>
                    <td>{{ $book->tacgia->TenTacGia ?? 'Chưa cập nhật' }}</td>
                    <td>{{ $book->nhaxuatban->TenNXB ?? 'Chưa cập nhật' }}</td>
                    <td>
                        @if ($book->donviphathanh)
                            {{ $book->donviphathanh->TenDVPH }}
                        @else
                            Không có
                        @endif
                    </td>
                    <td>{{ number_format($book->GiaNhap) }}₫</td>
                    <td>{{ number_format($book->GiaBan) }}₫</td>
                    <td>{{ $book->SoLuong }}</td>
                    <td>{{ $book->NamXuatBan }}</td>
                    <td>{{ $book->LuotMua ?? '0' }}</td>
                    <td>{{ $book->category->name ?? 'Không có' }}</td>
                    <td>{{ $book->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if ($book->TrangThai == 1)
                            <span class="badge badge-success">Đang hiển thị</span>
                        @else
                            <span class="badge badge-secondary">Đã ẩn</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary" data-toggle="modal"
                            data-target="#modalEdit{{ $book->MaSach }}">Sửa</button>
                        @if ($book->TrangThai == 1)
                            <form action="{{ route('admin.books.destroy', $book->MaSach) }}" method="POST"
                                style="display:inline;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Xác nhận ẩn sách?')"
                                    class="btn btn-sm btn-warning">Ẩn</button>
                            </form>
                        @else
                            <form action="{{ route('admin.books.restore', $book->MaSach) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button onclick="return confirm('Khôi phục sách này?')" class="btn btn-sm btn-success">Kích
                                    hoạt</button>
                            </form>
                        @endif
                    </td>
                </tr>

                {{-- Modal sửa --}}
                <div class="modal fade" id="modalEdit{{ $book->MaSach }}">
                    <div class="modal-dialog modal-lg">
                        <form method="POST" action="{{ route('admin.books.update', $book->MaSach) }}"
                            enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Sửa sách: {{ $book->TenSach }}</h5>
                                    <button class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    @include('admin.books._form_edit', ['book' => $book])
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
                        @include('admin.books._form_create')
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success">Lưu</button>
                        <button class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="quickAddTacGiaModal" tabindex="-1" role="dialog"
        aria-labelledby="quickAddTacGiaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="quickAddTacGiaForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm nhanh tác giả</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="quickTenTacGia">Tên tác giả</label>
                            <input type="text" class="form-control" name="TenTacGia" id="quickTenTacGia">
                        </div>
                        <div class="form-group">
                            <label for="quickNamSinh">Năm sinh</label>
                            <input type="number" class="form-control" name="NamSinh" id="quickNamSinh" min="1000"
                                max="2010">
                        </div>
                        <div class="alert alert-danger d-none" id="quickAddError"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Lưu</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@push('js')
    <script>
        // Toggle filter checkbox
        document.querySelectorAll('.filter-wrapper input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                this.parentElement.classList.toggle('active', this.checked);
            });
        });

        // Xử lý mở lại modal khi quickAdd đóng
        document.querySelectorAll('.btnAddTacGia').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const modalParent = btn.closest('.modal');
                if (modalParent) {
                    $(modalParent).modal('hide');
                    modalParent.classList.add('was-opened');
                }
                $('#quickAddTacGiaModal').modal('show');
            });
        });

        $('#quickAddTacGiaModal').on('hidden.bs.modal', function() {
            const prevModal = document.querySelector('.modal.was-opened');
            if (prevModal) {
                prevModal.classList.remove('was-opened');
                $(prevModal).modal('show');
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quickForm = document.getElementById('quickAddTacGiaForm');
            const errorBox = document.getElementById('quickAddError');
            const selectTacGia = document.getElementById('MaTacGiaAdd');

            quickForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(quickForm);
                errorBox.classList.add('d-none');
                errorBox.innerHTML = '';

                fetch("{{ route('admin.tacgia.quick_add') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Tạo option mới
                            const option = document.createElement('option');
                            option.value = data.tacgia.MaTacGia;
                            option.textContent = data.tacgia.TenTacGia;
                            option.selected = true;

                            // Thêm vào select và chọn
                            selectTacGia.appendChild(option);
                            $('#quickAddTacGiaModal').modal('hide');

                            // Cập nhật các input thông tin
                            document.getElementById('infoNamSinh').value = data.tacgia.nam_sinh || '';
                            document.getElementById('infoQueQuan').value = data.tacgia.que_quan_text ||
                                '';
                            document.getElementById('infoGhiChu').value = data.tacgia.ghi_chu || '';
                            document.querySelector('.infoTacGiaBox').style.display = 'block';
                        } else {
                            errorBox.classList.remove('d-none');
                            errorBox.textContent = data.message || 'Đã có lỗi xảy ra';
                        }
                    })
                    .catch(err => {
                        errorBox.classList.remove('d-none');
                        errorBox.textContent = 'Lỗi hệ thống. Vui lòng thử lại.';
                    });
            });
        });
    </script>


    @if (session('old_modal') && !$errors->has('GiaBan'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const oldModal = @json(session('old_modal'));
                const modalId = oldModal === 'add' ? '#modalAdd' : '#modalEdit' + oldModal.replace('edit_', '');
                $(modalId).modal('show');
            });
        </script>
    @endif
@endpush

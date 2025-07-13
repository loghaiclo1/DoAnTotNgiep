@extends('adminlte::page')

@section('title', 'Quản lý Tác giả')

@section('content_header')
    <h1>Quản lý tác giả</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control"
                    placeholder="Tìm theo tên tác giả">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-control">
                    <option value="">-- Tất cả trạng thái --</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Đang hiển thị</option>
                    <option value="trashed" {{ request('status') == 'trashed' ? 'selected' : '' }}>Đã ẩn</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter"></i> Lọc</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.tacgia.index') }}" class="btn btn-secondary w-100"><i class="fas fa-redo-alt"></i>
                    Reset</a>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCreateTacGia">
                    <i class="fas fa-plus"></i> Thêm tác giả
                </button>
            </div>
        </div>
    </form>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Danh sách tác giả</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-hover m-0">
                <thead class="table-light">
                    <tr>
                        <th>Mã tác giả</th>
                        <th>Tên tác giả</th>
                        <th>Giới tính</th>
                        <th>Năm sinh</th>
                        <th>Quê quán</th>
                        <th>Số sách</th>
                        <th>Thông tin thêm về tác giả</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tacgias as $tacgia)
                        <tr>
                            <td>{{ $tacgia->MaTacGia }}</td>
                            <td>{{ $tacgia->TenTacGia }}</td>
                            <td>{{ $tacgia->gioi_tinh }}</td>
                            <td>{{ $tacgia->nam_sinh ?? 'Chưa cập nhật' }}</td>
                            <td>
                                @if ($tacgia->xa)
                                    {{ $tacgia->xa->ten }},
                                    {{ optional($tacgia->xa->quanHuyen)->ten }},
                                    {{ optional(optional($tacgia->xa->quanHuyen)->tinhThanh)->ten }}
                                @else
                                    Chưa cập nhật
                                @endif

                            </td>
                            <td>{{ $tacgia->sach->count() }}</td>
                            <td>{{ $tacgia->ghi_chu ?? 'Không có' }}</td>
                            <td>{{ $tacgia->created_at ? $tacgia->created_at->format('d/m/Y H:i') : 'Không có' }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-primary btn-edit"
                                    data-id="{{ $tacgia->MaTacGia }}">
                                    Sửa
                                </button>

                                @if ($tacgia->trashed())
                                    <form action="{{ route('admin.tacgia.restore', $tacgia->MaTacGia) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Khôi phục tác giả này?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Hiện lại</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.tacgia.destroy', $tacgia->MaTacGia) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn ẩn tác giả này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-warning">Ẩn</button>
                                    </form>
                                @endif

                                <a href="{{ route('admin.tacgia.books', $tacgia->MaTacGia) }}" class="btn btn-sm btn-outline-info">
                                    Xem tác phẩm
                                </a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có tác giả nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-center">
            {{ $tacgias->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    {{-- Modal thêm --}}
    <div class="modal fade" id="modalCreateTacGia" tabindex="-1" role="dialog" aria-labelledby="modalCreateTacGiaLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.tacgia.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Thêm tác giả</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($errors->any() && !session('edit_open'))
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label>Tên tác giả</label>
                            <input type="text" name="TenTacGia" value="{{ old('TenTacGia') }}" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Năm sinh</label>
                            <input type="number" name="nam_sinh" value="{{ old('nam_sinh') }}" class="form-control"
                                min="1000" max="2010">
                        </div>
                        <div class="form-group">
                            <label>Giới tính</label>
                            <select name="gioi_tinh" class="form-control">
                                <option value="">-- Chọn giới tính --</option>
                                <option value="Nam" {{ old('gioi_tinh') == 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option value="Nữ" {{ old('gioi_tinh') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                <option value="Không rõ" {{ old('gioi_tinh') == 'Không rõ' ? 'selected' : '' }}>Không rõ
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tỉnh</label>
                            <select id="tinh" class="form-control">
                                <option value="">-- Chọn tỉnh --</option>
                                @foreach ($tinhs as $tinh)
                                    <option value="{{ $tinh->id }}">{{ $tinh->ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Quận/Huyện</label>
                            <select id="quanhuyen" class="form-control">
                                <option value="">-- Chọn quận/huyện --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Phường/Xã</label>
                            <select name="que_quan_id" id="que_quan_id" class="form-control">
                                <option value="">-- Chọn phường/xã --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ghi_chu">Thông tin thêm về tác giả <small class="text-muted">(không bắt
                                    buộc)</small></label>
                            <textarea name="ghi_chu" id="ghi_chu" class="form-control" rows="4"
                                placeholder="Nhập tiểu sử, thành tựu hoặc mô tả khác...">{{ old('ghi_chu', $tacgia->ghi_chu ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-success">Thêm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal sửa --}}
    <div class="modal fade" id="modalEditTacGia" tabindex="-1" role="dialog" aria-labelledby="modalEditTacGiaLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formEditTacGia" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Sửa tác giả</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($errors->any() && session('edit_open'))
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Tên tác giả</label>
                            <input type="text" name="TenTacGia" id="editTenTacGia" class="form-control"
                                value="{{ old('TenTacGia') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Giới tính</label>
                            <select name="gioi_tinh" id="editGioiTinh" class="form-control">
                                <option value="">-- Chọn giới tính --</option>
                                <option value="Nam" {{ old('gioi_tinh') == 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option value="Nữ" {{ old('gioi_tinh') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                <option value="Không rõ" {{ old('gioi_tinh') == 'Không rõ' ? 'selected' : '' }}>Không rõ
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Năm sinh</label>
                            <input type="number" name="nam_sinh" id="editNamSinh" class="form-control"
                                value="{{ old('nam_sinh') }}" min="1000" max="2010">
                        </div>
                        <div class="form-group">
                            <label>Tỉnh</label>
                            <select id="edit_tinh" class="form-control">
                                <option value="">-- Chọn tỉnh --</option>
                                @foreach ($tinhs as $tinh)
                                    <option value="{{ $tinh->id }}">{{ $tinh->ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Quận/Huyện</label>
                            <select id="edit_quanhuyen" class="form-control">
                                <option value="">-- Chọn quận/huyện --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Phường/Xã</label>
                            <select name="que_quan_id" id="edit_que_quan_id" class="form-control">
                                <option value="">-- Chọn phường/xã --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ghi_chu">Thông tin thêm về tác giả <small class="text-muted">(không bắt
                                    buộc)</small></label>
                            <textarea name="ghi_chu" id="editGhiChu" class="form-control"
                                placeholder="Nhập tiểu sử, thành tựu hoặc mô tả khác..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function loadDistricts(provinceId, districtSelectId, resetWard = true, selectedId = null) {
                fetch(`/api/quan-huyen/${provinceId}`)
                    .then(response => response.json())
                    .then(data => {
                        const districtSelect = document.getElementById(districtSelectId);
                        districtSelect.innerHTML = '<option value="">-- Chọn quận/huyện --</option>';
                        data.forEach(item => {
                            districtSelect.innerHTML +=
                                `<option value="${item.id}" ${selectedId == item.id ? 'selected' : ''}>${item.ten}</option>`;
                        });

                        if (resetWard) {
                            const wardSelect = document.getElementById(districtSelectId.replace('quanhuyen',
                                'que_quan_id'));
                            if (wardSelect) wardSelect.innerHTML =
                                '<option value="">-- Chọn phường/xã --</option>';
                        }
                    })
                    .catch(err => {
                        console.error('Lỗi tải Quận/Huyện:', err);
                        Toastify({
                            text: "Không thể tải danh sách Quận/Huyện. Vui lòng thử lại!",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#dc3545",
                        }).showToast();
                    });
            }

            function loadWards(districtId, wardSelectId, selectedId = null) {
                fetch(`/api/phuong-xa/${districtId}`)
                    .then(response => response.json())
                    .then(data => {
                        const wardSelect = document.getElementById(wardSelectId);
                        wardSelect.innerHTML = '<option value="">-- Chọn phường/xã --</option>';
                        data.forEach(item => {
                            wardSelect.innerHTML +=
                                `<option value="${item.id}" ${selectedId == item.id ? 'selected' : ''}>${item.ten}</option>`;
                        });
                    })
                    .catch(err => {
                        console.error('Lỗi tải Phường/Xã:', err);
                        Toastify({
                            text: "Không thể tải danh sách Phường/Xã. Vui lòng thử lại!",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#dc3545",
                        }).showToast();
                    });
            }

            // Sự kiện chọn Tỉnh (Thêm tác giả)
            document.getElementById('tinh')?.addEventListener('change', function() {
                loadDistricts(this.value, 'quanhuyen');
            });

            // Sự kiện chọn Quận/Huyện (Thêm tác giả)
            document.getElementById('quanhuyen')?.addEventListener('change', function() {
                loadWards(this.value, 'que_quan_id');
            });

            // Nếu có lỗi validation → mở lại modal thêm và load địa chỉ tương ứng
            @if ($errors->any() && !session('edit_open') && old('que_quan_id'))
                const xaId = {{ old('que_quan_id') }};
                fetch(`/api/get-diachi-from-xa/${xaId}`)
                    .then(response => response.json())
                    .then(res => {
                        if (res.success) {
                            const {
                                tinh,
                                huyen,
                                xa
                            } = res;
                            document.getElementById('tinh').value = tinh.id;
                            return fetch(`/api/quan-huyen/${tinh.id}`)
                                .then(response => response.json())
                                .then(quans => {
                                    const districtSelect = document.getElementById('quanhuyen');
                                    districtSelect.innerHTML =
                                        '<option value="">-- Chọn quận/huyện --</option>';
                                    quans.forEach(q => {
                                        districtSelect.innerHTML +=
                                            `<option value="${q.id}" ${q.id == huyen.id ? 'selected' : ''}>${q.ten}</option>`;
                                    });

                                    return fetch(`/api/phuong-xa/${huyen.id}`);
                                })
                                .then(response => response.json())
                                .then(xas => {
                                    const wardSelect = document.getElementById('que_quan_id');
                                    wardSelect.innerHTML = '<option value="">-- Chọn phường/xã --</option>';
                                    xas.forEach(x => {
                                        wardSelect.innerHTML +=
                                            `<option value="${x.id}" ${x.id == xa.id ? 'selected' : ''}>${x.ten}</option>`;
                                    });
                                });
                        }
                    })
                    .catch(err => console.error('Lỗi khi load địa chỉ mặc định:', err));
            @endif
        });
    </script>


    @if ($errors->any() && !session('edit_open'))
        <script>
            $(document).ready(function() {
                $('#modalCreateTacGia').modal('show');
            });
        </script>
    @endif

    @if (session('edit_open') && old('que_quan_id'))
        <script>
            $(document).ready(function() {
                const xaId = {{ old('que_quan_id') }};

                // Mở lại modal sửa
                $('#modalEditTacGia').modal('show');

                // Gọi API để lấy tỉnh/huyện từ phường xã
                fetch(`/api/get-diachi-from-xa/${xaId}`)
                    .then(response => response.json())
                    .then(res => {
                        if (res.success) {
                            const {
                                tinh,
                                huyen,
                                xa
                            } = res;

                            document.getElementById('edit_tinh').value = tinh.id;

                            // Load quận/huyện
                            fetch(`/api/quan-huyen/${tinh.id}`)
                                .then(response => response.json())
                                .then(quans => {
                                    const districtSelect = document.getElementById('edit_quanhuyen');
                                    districtSelect.innerHTML =
                                        '<option value="">-- Chọn quận/huyện --</option>';
                                    quans.forEach(q => {
                                        districtSelect.innerHTML +=
                                            `<option value="${q.id}" ${q.id == huyen.id ? 'selected' : ''}>${q.ten}</option>`;
                                    });

                                    // Load phường/xã
                                    return fetch(`/api/phuong-xa/${huyen.id}`);
                                })
                                .then(response => response.json())
                                .then(xas => {
                                    const wardSelect = document.getElementById('edit_que_quan_id');
                                    wardSelect.innerHTML = '<option value="">-- Chọn phường/xã --</option>';
                                    xas.forEach(x => {
                                        wardSelect.innerHTML +=
                                            `<option value="${x.id}" ${x.id == xa.id ? 'selected' : ''}>${x.ten}</option>`;
                                    });
                                });
                        }
                    })
                    .catch(err => console.error('Lỗi khi load địa chỉ trong modal sửa:', err));
            });
        </script>
    @endif

    <script>
        // Sự kiện chọn tỉnh trong modal sửa
        document.getElementById('edit_tinh')?.addEventListener('change', function() {
            fetch(`/api/quan-huyen/${this.value}`)
                .then(response => response.json())
                .then(data => {
                    const districtSelect = document.getElementById('edit_quanhuyen');
                    districtSelect.innerHTML = '<option value="">-- Chọn quận/huyện --</option>';
                    data.forEach(item => {
                        districtSelect.innerHTML += `<option value="${item.id}">${item.ten}</option>`;
                    });

                    // Reset phường/xã
                    document.getElementById('edit_que_quan_id').innerHTML =
                        '<option value="">-- Chọn phường/xã --</option>';
                });
        });

        // Sự kiện chọn quận/huyện trong modal sửa
        document.getElementById('edit_quanhuyen')?.addEventListener('change', function() {
            fetch(`/api/phuong-xa/${this.value}`)
                .then(response => response.json())
                .then(data => {
                    const wardSelect = document.getElementById('edit_que_quan_id');
                    wardSelect.innerHTML = '<option value="">-- Chọn phường/xã --</option>';
                    data.forEach(item => {
                        wardSelect.innerHTML += `<option value="${item.id}">${item.ten}</option>`;
                    });
                });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.btn-edit');

            editButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;

                    fetch(`/admin/tacgia/${id}/edit`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                const tacgia = data.tacgia;

                                // Set action form update
                                const form = document.getElementById('formEditTacGia');
                                form.action = `/admin/tacgia/${id}`;

                                // Gán giá trị vào input
                                document.getElementById('editTenTacGia').value = tacgia
                                    .TenTacGia;
                                document.getElementById('editNamSinh').value = tacgia
                                    .nam_sinh || '';
                                document.getElementById('editGhiChu').value = tacgia.ghi_chu ||
                                    '';
                                document.getElementById('editGioiTinh').value = tacgia
                                    .gioi_tinh || '';


                                // Load địa chỉ
                                if (tacgia.que_quan_id) {
                                    fetch(`/api/get-diachi-from-xa/${tacgia.que_quan_id}`)
                                        .then(response => response.json())
                                        .then(res => {
                                            if (res.success) {
                                                const {
                                                    tinh,
                                                    huyen,
                                                    xa
                                                } = res;

                                                document.getElementById('edit_tinh').value =
                                                    tinh.id;

                                                // Load quận/huyện
                                                fetch(`/api/quan-huyen/${tinh.id}`)
                                                    .then(response => response.json())
                                                    .then(quans => {
                                                        const districtSelect = document
                                                            .getElementById(
                                                                'edit_quanhuyen');
                                                        districtSelect.innerHTML =
                                                            '<option value="">-- Chọn quận/huyện --</option>';
                                                        quans.forEach(q => {
                                                            districtSelect
                                                                .innerHTML +=
                                                                `<option value="${q.id}" ${q.id == huyen.id ? 'selected' : ''}>${q.ten}</option>`;
                                                        });

                                                        // Load phường/xã
                                                        return fetch(
                                                            `/api/phuong-xa/${huyen.id}`
                                                        );
                                                    })
                                                    .then(response => response.json())
                                                    .then(xas => {
                                                        const wardSelect = document
                                                            .getElementById(
                                                                'edit_que_quan_id');
                                                        wardSelect.innerHTML =
                                                            '<option value="">-- Chọn phường/xã --</option>';
                                                        xas.forEach(x => {
                                                            wardSelect
                                                                .innerHTML +=
                                                                `<option value="${x.id}" ${x.id == xa.id ? 'selected' : ''}>${x.ten}</option>`;
                                                        });
                                                    });
                                            }
                                        });
                                } else {
                                    document.getElementById('edit_tinh').value = '';
                                    document.getElementById('edit_quanhuyen').innerHTML =
                                        '<option value="">-- Chọn quận/huyện --</option>';
                                    document.getElementById('edit_que_quan_id').innerHTML =
                                        '<option value="">-- Chọn phường/xã --</option>';
                                }

                                $('#modalEditTacGia').modal('show');
                            } else {
                                alert('Không tìm thấy tác giả');
                            }
                        })
                        .catch(err => {
                            console.error('Lỗi khi lấy dữ liệu tác giả:', err);
                            alert('Lỗi khi tải dữ liệu tác giả');
                        });
                });
            });
        });
    </script>
@endsection

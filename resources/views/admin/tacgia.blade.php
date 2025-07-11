    @extends('adminlte::page')

    @section('title', 'Quản lý Tác giả')

    @section('content_header')
        <h1>Danh sách tác giả</h1>
    @endsection

    @section('content')
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Form lọc --}}
        <form method="GET" class="mb-4">
            <div class="row g-2 align-items-center">
                <div class="col-md-4">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control"
                        placeholder="Tìm theo tên tác giả">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter"></i> Lọc
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.tacgia.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-redo-alt"></i> Reset
                    </a>
                </div>
                <div class="col-md-4 text-end">
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
                            <th>ID</th>
                            <th>Tên tác giả</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tacgias as $tacgia)
                            <tr>
                                <td>{{ $tacgia->MaTacGia }}</td>
                                <td>{{ $tacgia->TenTacGia }}</td>
                                <td>{{ $tacgia->created_at ? $tacgia->created_at->format('d/m/Y H:i') : '—' }}</td>
                                <td>
                                    <button type="button"
    class="btn btn-sm btn-outline-primary btn-edit"
    data-id="{{ $tacgia->MaTacGia }}">
    Sửa
</button>

                                    <form action="{{ route('admin.tacgia.destroy', $tacgia->MaTacGia) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa tác giả này không?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Không có tác giả nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="text-muted mb-2">
                Hiển thị từ {{ $tacgias->firstItem() }} đến {{ $tacgias->lastItem() }} trong tổng số {{ $tacgias->total() }}
                kết quả
            </div>

            <div class="card-footer" style="display: flex; justify-content: center;">
                {{ $tacgias->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
        <!-- Modal thêm tác giả -->
        <div class="modal fade" id="modalCreateTacGia" tabindex="-1" aria-labelledby="modalCreateTacGiaLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.tacgia.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="modalCreateTacGiaLabel">Thêm tác giả mới</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
    <span aria-hidden="true">&times;</span>
</button>                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="TenTacGia" class="form-label">Tên tác giả</label>
                                <input type="text" name="TenTacGia" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-success">Thêm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal sửa tác giả -->
<div class="modal fade" id="modalEditTacGia" tabindex="-1" aria-labelledby="modalEditTacGiaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditTacGia" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalEditTacGiaLabel">Chỉnh sửa tác giả</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="MaTacGia" id="editMaTacGia">
                    <div class="mb-3">
                        <label for="editTenTacGia" class="form-label">Tên tác giả</label>
                        <input type="text" name="TenTacGia" id="editTenTacGia" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
</div>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @endsection
@section('js')
    @if ($errors->any())
        <script>
            $(document).ready(function () {
                $('#modalCreateTacGia').modal('show');
            });
        </script>
    @endif
    <script>
    $(document).ready(function () {
        // Bấm nút Sửa
        $('.btn-edit').click(function () {
            let id = $(this).data('id');

            $.get('/admin/tacgia/' + id, function (data) {
                $('#editMaTacGia').val(data.MaTacGia);
                $('#editTenTacGia').val(data.TenTacGia);
                $('#formEditTacGia').attr('action', '/admin/tacgia/' + id);
                $('#modalEditTacGia').modal('show');
            });
        });
    });
</script>
@endsection


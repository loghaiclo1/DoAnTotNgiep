@extends('adminlte::page')

@section('title', 'Chi tiết tác giả')

@section('content_header')
    <h1>Chi tiết tác giả: {{ $tacgia->TenTacGia }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>Mã tác giả:</strong> {{ $tacgia->MaTacGia }}</p>
            <p><strong>Giới tính:</strong> {{ $tacgia->gioi_tinh }}</p>
            <p><strong>Năm sinh:</strong> {{ $tacgia->nam_sinh ?? 'Chưa cập nhật' }}</p>
            <p><strong>Quê quán:</strong>
                @if ($tacgia->xa)
                    {{ $tacgia->xa->ten }},
                    {{ optional($tacgia->xa->quanHuyen)->ten }},
                    {{ optional(optional($tacgia->xa->quanHuyen)->tinhThanh)->ten }}
                @else
                    Chưa cập nhật
                @endif
            </p>
            <p><strong>Ghi chú:</strong> {{ $tacgia->ghi_chu ?? 'Không có' }}</p>
        </div>
    </div>
    <a href="{{ route('admin.tacgia.index') }}" class="btn btn-secondary mt-3">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
    <form method="GET" class="row g-3 align-items-center p-3">
        <div class="col-auto">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Tìm tên sách...">
        </div>
        <div class="col-auto">
            <select name="status" class="form-select">
                <option value="">-- Trạng thái --</option>
                <option value="con" {{ request('status') == 'con' ? 'selected' : '' }}>Còn hàng</option>
                <option value="het" {{ request('status') == 'het' ? 'selected' : '' }}>Hết hàng</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Tìm kiếm
            </button>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.tacgia.show', $tacgia->MaTacGia) }}" class="btn btn-secondary">
                <i class="fas fa-redo"></i> Đặt lại
            </a>
        </div>
    </form>

    <h4 class="mt-4">Danh sách tác phẩm</h4>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Mã sách</th>
                        <th>Ảnh</th>
                        <th>Tên sách</th>
                        <th>Giá bán</th>
                        <th>Số lượng</th>
                        <th>Năm xuất bản</th>
                        <th>Danh mục</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tacgia->sach as $sach)
                        <tr>
                            <td>{{ $sach->MaSach }}</td>
                            <td><img src="{{ asset('image/book/' . $sach->HinhAnh) }}" width="50"></td>
                            <td>{{ $sach->TenSach }}</td>
                            <td>{{ number_format($sach->GiaBan, 0, ',', '.') }} đ</td>
                            <td>{{ $sach->SoLuong }}</td>
                            <td>{{ $sach->NamXuatBan ?? '—' }}</td>
                            <td>{{ $sach->category->name ?? '—' }}</td>
                            <td>
                                @if ($sach->SoLuong > 0)
                                    <span class="badge bg-success">Còn hàng</span>
                                @else
                                    <span class="badge bg-warning">Hết hàng</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Không có tác phẩm nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

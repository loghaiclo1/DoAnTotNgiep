@extends('adminlte::page')

@section('title', 'Chi tiết tác giả')

@section('content_header')
    <h1>Chi tiết tác giả: {{ $tacgia->TenTacGia }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>Mã tác giả:</strong> {{ $tacgia->MaTacGia }}</p>
            <p><strong>Năm sinh:</strong> {{ $tacgia->nam_sinh ?? 'Chưa cập nhật' }}</p>
            <p><strong>Quê quán:</strong> {{ optional($tacgia->que_quan)->ten ?? 'Chưa cập nhật' }}</p>
            <p><strong>Ghi chú:</strong> {{ $tacgia->ghi_chu ?? '—' }}</p>
        </div>
    </div>
    <a href="{{ route('admin.tacgia.index') }}" class="btn btn-secondary mt-3">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
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

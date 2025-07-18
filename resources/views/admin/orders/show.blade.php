@extends('adminlte::page')

@section('title', 'Chi tiết đơn hàng')

@section('content_header')
    <h1>Chi tiết đơn hàng #ORD-{{ $donhang->NgayLap->format('Y') }}-{{ $donhang->MaHoaDon }}</h1>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-4">
        <strong>Khách hàng:</strong> {{ $donhang->khachhang->Ho . ' ' . $donhang->khachhang->Ten ?? 'Không có' }}<br>
        <strong>Thời gian đặt:</strong> {{ $donhang->NgayLap ? $donhang->NgayLap->format('H:i d/m/Y ') : 'N/A' }}<br>
        <strong>Địa chỉ:</strong> {{ $donhang->DiaChi }}<br>
        <strong>SĐT:</strong> {{ $donhang->SoDienThoai }}<br>
        <strong>Ghi chú:</strong> {{ $donhang->GhiChu ?? 'Không có' }}<br>
        <strong>Trạng thái:</strong> {{ $donhang->TrangThai }}<br>
    </div>

    <h4 class="mt-4">Danh sách sản phẩm:</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên sách</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($donhang->chitiethoadon as $ct)
                <tr>
                    <td>{{ $ct->sach->TenSach ?? 'N/A' }}</td>
                    <td>{{ number_format($ct->DonGia) }}₫</td>
                    <td>{{ $ct->SoLuong }}</td>
                    <td>{{ number_format($ct->DonGia * $ct->SoLuong) }}₫</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($donhang->TrangThai === 'Hủy đơn')

    @if (session()->has('refund_confirmed_' . $donhang->MaHoaDon))
        <div class="alert alert-success mt-3">
             Đã hoàn tiền cho khách hàng.
        </div>
    @else
        <form action="{{ route('admin.orders.confirmRefund', ['id' => $donhang->MaHoaDon]) }}" method="POST">
            @csrf
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="confirm_refund" id="confirm_refund" required>
                <label class="form-check-label" for="confirm_refund">
                    Tôi xác nhận đã hoàn tiền cho khách hàng.
                </label>
            </div>
            <button type="submit" class="btn btn-danger mt-2">Xác nhận đã hoàn tiền</button>
        </form>
    @endif

@endif


    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">← Quay lại danh sách</a>

@stop
@push('js')
    <script>
        document.getElementById('updateForm').addEventListener('submit', function(e) {
            const selected = document.querySelector('select[name="TrangThai"]').value;
            if (selected === 'Hủy đơn') {
                const confirmed = confirm(
                    'Bạn có chắc chắn muốn hủy đơn hàng này không? Hành động này không thể hoàn tác.');
                if (!confirmed) {
                    e.preventDefault(); // Hủy gửi form
                }
            }
        });
    </script>
@endpush

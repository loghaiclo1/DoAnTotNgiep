    @extends('adminlte::page')

    @section('title', 'Quản lý Đơn hàng')

    @section('content_header')
        <h1>Đơn hàng mới nhất</h1>
    @stop

    @section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->MaHoaDon }}</td>
                <td>{{ $order->khachhang->HoTen ?? 'Khách vãng lai' }}</td>
                <td>{{ $order->NgayDat }}</td>
                <td>
                    @switch($order->TrangThai)
                        @case(0) <span class="badge badge-warning">Chờ xử lý</span> @break
                        @case(1) <span class="badge badge-info">Đã xác nhận</span> @break
                        @case(2) <span class="badge badge-success">Hoàn tất</span> @break
                        @case(3) <span class="badge badge-danger">Đã hủy</span> @break
                        @default <span class="badge badge-secondary">Không xác định</span>
                    @endswitch
                </td>
                <td>{{ number_format($order->TongTien) }}₫</td>
                <td>
                    <a href="{{ route('admin.donhang.show', $order->MaHoaDon) }}" class="btn btn-info btn-sm">Xem</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {{ $orders->links('vendor.pagination.bootstrap-4') }}
    @stop

@extends('adminlte::page')

@section('title', 'Yêu cầu hủy đơn')

@section('content_header')
    <h1>Danh sách yêu cầu hủy đơn</h1>
@stop

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
    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="q" class="form-control" placeholder="Tìm theo mã đơn, tên KH hoặc SĐT"
                    value="{{ request('q') }}">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </div>
    </form>
    <div class="table-responsive" style="max-height: 650px; overflow-y: auto;">
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-dark sticky-top bg-white">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Khách hàng</th>
                    <th>SĐT</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Phương thức thanh toán</th>
                    <th>Lý do hủy</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>#ORD-{{ $order->NgayLap->format('Y') }}-{{ $order->MaHoaDon }}</td>
                        <td>{{ $order->khachhang ? $order->khachhang->Ho . ' ' . $order->khachhang->Ten : 'Không rõ' }}</td>
                        <td>{{ $order->SoDienThoai ?? 'N/A' }}</td>
                        <td>{{ optional($order->NgayLap)->format('d/m/Y H:i') }}</td>
                        <td>{{ number_format($order->TongTien, 0, ',', '.') }}₫</td>
                        <td>
                            @php
                                echo $order->PT_ThanhToan == 1
                                    ? 'Thanh toán khi nhận hàng (COD)'
                                    : ($order->PT_ThanhToan == 2
                                        ? 'VNPay'
                                        : 'Không xác định');
                            @endphp
                        </td>
                        <td>{{ $order->LyDoHuy ?? 'Không rõ' }}</td>
                        <td class="d-flex gap-1" style="justify-content: space-evenly">
                            <!-- Duyệt -->
                            <form method="POST" action="{{ route('admin.orders.cancel-approve') }}">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->MaHoaDon }}">
                                <input type="hidden" name="action" value="approve">
                                <button type="submit" class="btn btn-sm btn-success">
                                    Chấp nhận
                                </button>
                            </form>

                            <!-- Từ chối -->
                            <form method="POST" action="{{ route('admin.orders.cancel-approve') }}">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->MaHoaDon }}">
                                <input type="hidden" name="action" value="reject">
                                <button type="submit" class="btn btn-sm btn-secondary">
                                    Từ chối
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Không có yêu cầu hủy.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $orders->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
    </div>
@endsection

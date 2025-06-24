@extends('adminlte::page')

@section('title', 'Quản lý Đơn hàng')

@section('content_header')
    <h1>Danh sách đơn hàng</h1>
@endsection

@section('content')
<div class="mb-3">
    <form method="GET" action="{{ route('admin.orders') }}" class="form-inline">
        <input type="text" name="search" class="form-control mr-2" placeholder="Mã đơn, tên khách..." value="{{ request('search') }}">

        <select name="trang_thai" class="form-control mr-2">
            <option value="">-- Trạng thái --</option>
            <option value="pending" {{ request('trang_thai') === 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
            <option value="processing" {{ request('trang_thai') === 'processing' ? 'selected' : '' }}>Đang xử lý</option>
            <option value="completed" {{ request('trang_thai') === 'completed' ? 'selected' : '' }}>Đã giao</option>
            <option value="cancelled" {{ request('trang_thai') === 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
        </select>

        <select name="sort" class="form-control mr-2">
            <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Mới nhất</option>
            <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Cũ nhất</option>
        </select>

        <button type="submit" class="btn btn-primary">Lọc</button>
    </form>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách đơn hàng</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Email</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>#{{ $order->ma_don }}</td>
                    <td>{{ $order->ten_khach }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ number_format($order->tong_tien) }}₫</td>
                    <td>
                        @php
                            $statusClass = match($order->trang_thai) {
                                'pending' => 'warning',
                                'processing' => 'info',
                                'completed' => 'success',
                                'cancelled' => 'danger',
                                default => 'secondary'
                            };
                        @endphp
                        <span class="badge badge-{{ $statusClass }}">
                            {{ ucfirst($order->trang_thai) }}
                        </span>
                    </td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#orderModal{{ $order->id }}" class="btn btn-info btn-sm">Xem</a>
                    </td>
                </tr>

                <!-- Modal chi tiết đơn -->
                <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Chi tiết đơn hàng #{{ $order->ma_don }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Khách hàng:</strong> {{ $order->ten_khach }}</p>
                                <p><strong>Email:</strong> {{ $order->email }}</p>
                                <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                                <p><strong>Trạng thái:</strong> {{ ucfirst($order->trang_thai) }}</p>
                                <hr>
                                <h5>Sản phẩm</h5>
                                <ul>
                                    @foreach ($order->items as $item)
                                        <li>{{ $item->ten_sach }} x {{ $item->so_luong }} - {{ number_format($item->gia_ban) }}₫</li>
                                    @endforeach
                                </ul>
                                <hr>
                                <p><strong>Tổng tiền:</strong> {{ number_format($order->tong_tien) }}₫</p>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
            </tbody>
        </table>

        <div class="mt-3 d-flex justify-content-center">
            {{ $orders->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
        </div>
        <div class="text-muted mb-2">
            Hiển thị từ {{ $orders->firstItem() }} đến {{ $orders->lastItem() }} trong tổng số {{ $orders->total() }} đơn hàng
        </div>
    </div>
</div>
@endsection

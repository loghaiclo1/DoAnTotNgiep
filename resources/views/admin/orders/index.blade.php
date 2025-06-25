@extends('adminlte::page')

@section('title', 'Quản lý đơn hàng')

@section('content_header')
    <h1>Danh sách đơn hàng</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="form-filter row align-items-center g-2 mb-3">
        {{-- Tìm kiếm --}}
        <div class="col-md-6">
            <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên khách hàng..."
                value="{{ request('keyword') }}">
        </div>

        <div style="width: 50%; display: flex; justify-content: space-around;">
            {{-- Số đơn/trang --}}
            <div class="col-md-2">
                <select name="per_page" class="form-select">
                    @foreach ([5, 10, 20, 50, 100] as $perPage)
                        <option value="{{ $perPage }}" {{ request('per_page', 10) == $perPage ? 'selected' : '' }}>
                            {{ $perPage }} đơn/trang
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Trạng thái --}}
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">-- Tất cả trạng thái --</option>
                    @foreach (['Đang chờ', 'Đã xác nhận', 'Đang giao hàng', 'Hoàn tất', 'Hủy đơn'] as $tt)
                        <option value="{{ $tt }}" {{ request('status') == $tt ? 'selected' : '' }}>
                            {{ $tt }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Sort + Lọc --}}
            <div class="col-md-2 d-flex gap-2">
                <select name="sort" class="form-select me-2">
                    <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Cũ nhất</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Tiền cao → thấp
                    </option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Tiền thấp → cao
                    </option>
                </select>
            </div>
            <div>
                <button class="btn btn-primary">Lọc</button>
            </div>

        </div>
    </form>

    <div class="table-responsive" style="max-height: 650px; overflow-y: auto;">
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-dark sticky-top bg-white">
                <tr>
                    <th style="min-width: 150px;">Mã đơn hàng</th>
                    <th>Khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>#ORD-{{ $order->NgayLap->format('Y') }}-{{ $order->MaHoaDon }}</td>
                        <td>{{ $order->khachhang ? $order->khachhang->Ho . ' ' . $order->khachhang->Ten : 'Không có' }}
                        </td>
                        <td>{{ $order->NgayLap ? $order->NgayLap->format('d/m/Y H:i') : 'N/A' }}</td>
                        <td>{{ number_format($order->TongTien) }}₫</td>
                        <td>{{ $order->TrangThai }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->MaHoaDon) }}"
                                class="btn btn-sm btn-info">Xem</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Không tìm thấy tiêu chí phù hợp.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $orders->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
    </div>
@stop

@push('css')
    <style>
        thead.sticky-top th {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 10;
        }

        .form-filter .form-control,
        .form-filter .form-select,
        .form-filter .btn {
            height: 40px;
            /* hoặc 38px tùy theo form-control mặc định */
            padding: 6px 12px;
            font-size: 16px;
        }

        .form-filter .col-md-2,
        .form-filter .col-md-6 {
            padding-right: 10px;
        }

        .form-filter .d-flex>* {
            flex: 1 1 auto;
        }

        @media (max-width: 768px) {

            .form-filter .col-md-2,
            .form-filter .col-md-6 {
                margin-bottom: 10px;
            }
        }
    </style>
@endpush

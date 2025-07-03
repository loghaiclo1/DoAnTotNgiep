@extends('adminlte::page')

@section('right-navbar')
    @include('components.admin.logout-link')
@endsection

@section('title', 'Dashboard')

@section('content_header')
    <h1>Trang quản trị</h1>
@stop

@section('content')
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row">
    @php
        $boxes = [
            ['count' => $totalOrders, 'text' => 'Tổng đơn hàng', 'icon' => 'fas fa-shopping-cart', 'color' => 'info', 'route' => 'admin.orders.index'],
            ['count' => number_format($totalRevenue).'₫', 'text' => 'Tổng doanh thu', 'icon' => 'fas fa-dollar-sign', 'color' => 'success', 'route' => 'admin.orders.index'],
            ['count' => $totalUsers, 'text' => 'Người dùng', 'icon' => 'fas fa-users', 'color' => 'warning', 'route' => 'admin.accounts.index'],
            ['count' => $totalProducts, 'text' => 'Sản phẩm', 'icon' => 'fas fa-book', 'color' => 'danger', 'route' => 'admin.books.index'],
            ['count' => $totalBooksSold, 'text' => 'Sách đã bán', 'icon' => 'fas fa-book-open', 'color' => 'primary', 'route' => 'admin.books.index'],
            ['count' => $totalReviews, 'text' => 'Đánh giá', 'icon' => 'fas fa-star', 'color' => 'secondary', 'route' => 'admin.reviews.index'],
            ['count' => $pendingContacts, 'text' => 'Liên hệ chờ xử lý', 'icon' => 'fas fa-envelope', 'color' => 'dark', 'route' => 'admin.contacts'],
        ];
    @endphp

    @foreach($boxes as $box)
        <div class="col-lg-3 col-6 mb-3">
            <div class="small-box bg-{{ $box['color'] }}">
                <div class="inner">
                    <h3>{{ $box['count'] }}</h3>
                    <p>{{ $box['text'] }}</p>
                </div>
                <div class="icon">
                    <i class="{{ $box['icon'] }}"></i>
                </div>
                <a href="{{ route($box['route']) }}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @endforeach
</div>

{{-- Biểu đồ doanh thu --}}
<div class="card">
    <div class="card-header"><h3 class="card-title">Thống kê doanh thu 6 tháng gần nhất</h3></div>
    <div class="card-body">
        <canvas id="revenueChart" style="max-height: 300px;"></canvas>
    </div>
</div>

{{-- Biểu đồ trạng thái đơn hàng --}}
<div class="card">
    <div class="card-header"><h3 class="card-title">Tỉ lệ trạng thái đơn hàng</h3></div>
    <div class="card-body">
        <canvas id="statusChart" style="max-height: 300px;"></canvas>
    </div>
</div>

{{-- Top 5 sản phẩm bán chạy --}}
<div class="card">
    <div class="card-header"><h3 class="card-title">Top 5 sản phẩm bán chạy</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Sản phẩm</th><th>Số lượng bán</th></tr></thead>
            <tbody>
                @foreach($topProducts as $product)
                    <tr>
                        <td>{{ $product->sach->TenSach ?? 'Không rõ' }}</td>
                        <td>{{ $product->total_sold }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Top 5 khách hàng chi nhiều nhất --}}
<div class="card">
    <div class="card-header"><h3 class="card-title">Top 5 khách hàng chi tiêu nhiều nhất</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Khách hàng</th><th>Tổng chi tiêu</th><th>Số đơn</th></tr></thead>
            <tbody>
                @foreach($topUsers as $user)
                    <tr>
                        <td>{{ ($user->khachhang->Ho ?? '') . ' ' . ($user->khachhang->Ten ?? '') ?: 'Không rõ' }}</td>
                        <td>{{ number_format($user->total_spent) }}₫</td>
                        <td>{{ $user->orders_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Biểu đồ doanh thu
    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: {!! json_encode($data) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                borderRadius: 4,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { callback: value => value.toLocaleString('vi-VN') + '₫' }
                }
            }
        }
    });

    // Biểu đồ trạng thái đơn hàng
    const statusData = {!! json_encode($ordersByStatus) !!};
    const statusLabels = Object.keys(statusData);
    const statusCounts = Object.values(statusData);
    new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: statusLabels,
            datasets: [{
                data: statusCounts,
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6c757d'],
            }]
        },
        options: { responsive: true }
    });
});
</script>
@endpush

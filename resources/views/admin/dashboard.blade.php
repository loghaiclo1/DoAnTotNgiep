@extends('adminlte::page')

@section('title', 'Trang quản trị')

@section('content_header')
    <h1 class="mb-4">Bảng điều khiển</h1>
@stop

@section('content')

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

{{-- THỐNG KÊ TỔNG QUAN --}}
<div class="row">
    @foreach ([
        ['label' => 'Đơn hàng', 'value' => $totalOrders, 'icon' => 'fas fa-receipt', 'color' => 'info', 'route' => 'admin.orders.index'],
        ['label' => 'Doanh thu', 'value' => number_format($totalRevenue) . '₫', 'icon' => 'fas fa-coins', 'color' => 'success', 'route' => 'admin.orders.index'],
        ['label' => 'Người dùng', 'value' => $totalUsers, 'icon' => 'fas fa-users', 'color' => 'primary', 'route' => 'admin.accounts.index'],
        ['label' => 'Sản phẩm', 'value' => $totalProducts, 'icon' => 'fas fa-book', 'color' => 'warning', 'route' => 'admin.books.index'],
        ['label' => 'Sách đã bán', 'value' => $totalBooksSold, 'icon' => 'fas fa-book-open', 'color' => 'dark', 'route' => 'admin.books.index'],
        ['label' => 'Đánh giá', 'value' => $totalReviews, 'icon' => 'fas fa-star', 'color' => 'secondary', 'route' => 'admin.reviews.index'],
        ['label' => 'Liên hệ chờ xử lý', 'value' => $pendingContacts, 'icon' => 'fas fa-envelope', 'color' => 'danger', 'route' => 'admin.contacts'],
    ] as $item)
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="small-box bg-{{ $item['color'] }}">
                <div class="inner">
                    <h3>{{ $item['value'] }}</h3>
                    <p>{{ $item['label'] }}</p>
                </div>
                <div class="icon">
                    <i class="{{ $item['icon'] }}"></i>
                </div>
                <a href="{{ route($item['route']) }}" class="small-box-footer">
                    Xem chi tiết <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endforeach
</div>
<div class="mb-4">
    <button class="btn btn-outline-primary m-1" onclick="showChart('dailyRevenueCard')">
        <i class="fas fa-calendar-day"></i> Doanh thu ngày
    </button>
    <button class="btn btn-outline-info m-1" onclick="showChart('monthlyRevenueCard')">
        <i class="fas fa-chart-bar"></i> Doanh thu tháng
    </button>
    <button class="btn btn-outline-success m-1" onclick="showChart('yearlyRevenueCard')">
        <i class="fas fa-calendar-alt"></i> Doanh thu năm
    </button>
    <button class="btn btn-outline-dark m-1" onclick="showChart('dailyOrderCard')">
        <i class="fas fa-box"></i> Đơn hàng ngày
    </button>
    <button class="btn btn-outline-secondary m-1" onclick="showChart('monthlyOrderCard')">
        <i class="fas fa-th-large"></i> Đơn hàng tháng
    </button>
    <button class="btn btn-outline-warning m-1" onclick="showChart('yearlyOrderCard')">
        <i class="fas fa-handshake"></i> Đơn hàng năm
    </button>
    <button class="btn btn-outline-indigo m-1" onclick="showChart('monthlyUserCard')">
        <i class="fas fa-user-plus"></i> Người dùng mới
    </button>
    <button class="btn btn-outline-orange m-1" onclick="showChart('booksSoldCard')">
        <i class="fas fa-book"></i> Sách đã bán
    </button>
</div>


{{-- CÁC BIỂU ĐỒ (mặc định hiện dailyRevenueCard + orderStatus) --}}
<div class="row">
    {{-- Biểu đồ chính (sẽ thay đổi) --}}
    <div class="col-md-6" id="dailyRevenueCard">
        <x-adminlte-card title="Doanh thu theo ngày" theme="primary" icon="fas fa-calendar-day">
            <canvas id="dailyRevenueChart"></canvas>
        </x-adminlte-card>
    </div>
    <div class="col-md-6" id="monthlyRevenueCard" style="display: none;">
        <x-adminlte-card title="Doanh thu theo tháng" theme="info" icon="fas fa-chart-bar">
            <canvas id="monthlyRevenueChart"></canvas>
        </x-adminlte-card>
    </div>
    <div class="col-md-6" id="yearlyRevenueCard" style="display: none;">
        <x-adminlte-card title="Doanh thu theo năm" theme="success" icon="fas fa-calendar-alt">
            <canvas id="yearlyRevenueChart"></canvas>
        </x-adminlte-card>
    </div>
    <div class="col-md-6" id="dailyOrderCard" style="display: none;">
        <x-adminlte-card title="Đơn hàng theo ngày" theme="dark" icon="fas fa-calendar-day">
            <canvas id="dailyOrderChart"></canvas>
        </x-adminlte-card>
    </div>
    <div class="col-md-6" id="monthlyOrderCard" style="display: none;">
        <x-adminlte-card title="Đơn hàng theo tháng" theme="cyan" icon="fas fa-calendar">
            <canvas id="monthlyOrderChart"></canvas>
        </x-adminlte-card>
    </div>
    <div class="col-md-6" id="yearlyOrderCard" style="display: none;">
        <x-adminlte-card title="Đơn hàng theo năm" theme="warning" icon="fas fa-calendar-alt">
            <canvas id="yearlyOrderChart"></canvas>
        </x-adminlte-card>
    </div>
    <div class="col-md-6" id="monthlyUserCard" style="display: none;">
        <x-adminlte-card title="Khách hàng mới theo tháng" theme="indigo" icon="fas fa-user-plus">
            <canvas id="monthlyUserChart"></canvas>
        </x-adminlte-card>
    </div>
    <div class="col-md-6" id="booksSoldCard" style="display: none;">
        <x-adminlte-card title="Sách đã bán theo tháng" theme="orange" icon="fas fa-book">
            <canvas id="booksSoldChart"></canvas>
        </x-adminlte-card>
    </div>

    {{-- Biểu đồ trạng thái luôn hiển thị --}}
    <div class="col-md-6">
        <x-adminlte-card title="Tỷ lệ trạng thái đơn hàng" theme="teal" icon="fas fa-chart-pie">
            <canvas id="orderStatusChart"></canvas>
        </x-adminlte-card>
    </div>
</div>
{{-- TOP SP & KH --}}
<x-adminlte-card title="Top 5 sản phẩm bán chạy" theme="success" icon="fas fa-fire">
    @if ($topProducts->isEmpty())
        <p class="text-center text-muted">Không có dữ liệu</p>
    @else
        <table class="table table-bordered">
            <thead><tr><th>Sản phẩm</th><th>Số lượng bán</th></tr></thead>
            <tbody>
                @foreach ($topProducts as $item)
                    <tr>
                        <td>{{ $item->sach->TenSach ?? 'Không rõ' }}</td>
                        <td>{{ $item->total_sold }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-adminlte-card>

<x-adminlte-card title="Top 5 khách hàng chi tiêu nhiều nhất" theme="warning" icon="fas fa-crown">
    @if ($topUsers->isEmpty())
        <p class="text-center text-muted">Không có dữ liệu</p>
    @else
        <table class="table table-bordered">
            <thead><tr><th>Khách hàng</th><th>Tổng chi</th><th>Số đơn</th></tr></thead>
            <tbody>
                @foreach ($topUsers as $user)
                    <tr>
                        <td>{{ optional($user->khachhang)->Ho }} {{ optional($user->khachhang)->Ten }}</td>
                        <td>{{ number_format($user->total_spent) }}₫</td>
                        <td>{{ $user->orders_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-adminlte-card>
@stop

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartConfigs = [
        { id: 'monthlyRevenueChart', labels: @json($labels), data: @json($data), label: 'Doanh thu', type: 'bar', color: '#36a2eb' },
        { id: 'dailyRevenueChart', labels: @json($dailyRevenueLabels), data: @json($dailyRevenueData), label: 'Doanh thu ngày', type: 'line', color: '#007bff' },
        { id: 'yearlyRevenueChart', labels: @json($yearLabels), data: @json($yearlyRevenueData), label: 'Doanh thu năm', type: 'bar', color: '#28a745' },
        { id: 'dailyOrderChart', labels: @json($dailyOrderLabels), data: @json($dailyOrderData), label: 'Đơn hàng ngày', type: 'line', color: '#343a40' },
        { id: 'monthlyOrderChart', labels: @json($monthlyOrderLabels), data: @json($monthlyOrderData), label: 'Đơn hàng tháng', type: 'bar', color: '#17a2b8' },
        { id: 'yearlyOrderChart', labels: @json($yearLabels), data: @json($yearlyOrderData), label: 'Đơn hàng năm', type: 'bar', color: '#ffc107' },
        { id: 'monthlyUserChart', labels: @json($monthlyUserLabels), data: @json($monthlyUserData), label: 'Người dùng mới', type: 'line', color: '#6610f2' },
        { id: 'booksSoldChart', labels: @json($booksSoldLabels), data: @json($booksSoldData), label: 'Sách đã bán', type: 'bar', color: '#fd7e14' },
    ];

    chartConfigs.forEach(cfg => {
        new Chart(document.getElementById(cfg.id), {
            type: cfg.type,
            data: {
                labels: cfg.labels,
                datasets: [{
                    label: cfg.label,
                    data: cfg.data,
                    backgroundColor: cfg.color + '66',
                    borderColor: cfg.color,
                    fill: cfg.type === 'line',
                    tension: 0.3,
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    });

    // Biểu đồ trạng thái đơn hàng
    new Chart(document.getElementById('orderStatusChart'), {
        type: 'pie',
        data: {
            labels: Object.keys(@json($ordersByStatus)),
            datasets: [{
                data: Object.values(@json($ordersByStatus)),
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6c757d'],
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Hàm ẩn/hiện card theo id
    function showChart(cardId) {
        const chartIds = [
    'dailyRevenueCard', 'monthlyRevenueCard', 'yearlyRevenueCard',
    'dailyOrderCard', 'monthlyOrderCard', 'yearlyOrderCard',
    'monthlyUserCard', 'booksSoldCard'
]

    chartIds.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.style.display = id === cardId ? 'block' : 'none';
        }
    });
}

</script>
@endpush

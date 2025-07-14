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
        ['label' => 'Tài khoản người dùng', 'value' => $totalUsers, 'icon' => 'fas fa-users', 'color' => 'primary', 'route' => 'admin.accounts.index'],
        ['label' => 'Sản phẩm', 'value' => $totalProducts, 'icon' => 'fas fa-book', 'color' => 'warning', 'route' => 'admin.books.index'],
        ['label' => 'Sách đã bán', 'value' => $totalBooksSold, 'icon' => 'fas fa-book-open', 'color' => 'dark', 'route' => 'admin.books.index'],
        ['label' => 'Đánh giá', 'value' => $totalReviews, 'icon' => 'fas fa-star', 'color' => 'secondary', 'route' => 'admin.reviews.index'],

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

{{-- Nút chọn biểu đồ --}}
<div class="mb-4">
    <button class="btn btn-outline-primary m-1" onclick="showChart('dailyRevenueCard')"><i class="fas fa-calendar-day"></i> Doanh thu ngày</button>
    <button class="btn btn-outline-info m-1" onclick="showChart('monthlyRevenueCard')"><i class="fas fa-chart-bar"></i> Doanh thu tháng</button>
    <button class="btn btn-outline-success m-1" onclick="showChart('yearlyRevenueCard')"><i class="fas fa-calendar-alt"></i> Doanh thu năm</button>
    <button class="btn btn-outline-dark m-1" onclick="showChart('dailyOrderCard')"><i class="fas fa-box"></i> Đơn hàng ngày</button>
    <button class="btn btn-outline-secondary m-1" onclick="showChart('monthlyOrderCard')"><i class="fas fa-th-large"></i> Đơn hàng tháng</button>
    <button class="btn btn-outline-warning m-1" onclick="showChart('yearlyOrderCard')"><i class="fas fa-handshake"></i> Đơn hàng năm</button>
    <button class="btn btn-outline-indigo m-1" onclick="showChart('monthlyUserCard')"><i class="fas fa-user-plus"></i> Người dùng mới</button>
    <button class="btn btn-outline-orange m-1" onclick="showChart('booksSoldCard')"><i class="fas fa-book"></i> Sách đã bán</button>
    <button class="btn btn-outline-purple m-1" onclick="showChart('booksCreatedCard')"><i class="fas fa-plus-square"></i> Sách mới thêm</button>
    <button class="btn btn-outline-brown m-1" onclick="showChart('booksImportedCard')"><i class="fas fa-truck-loading"></i> Sách nhập kho</button>
</div>

{{-- Biểu đồ --}}
<div class="row flex-wrap">
    {{-- Các biểu đồ chiếm 50% --}}
    @foreach ([
        'dailyRevenueCard' => ['title' => 'Doanh thu theo ngày', 'theme' => 'primary', 'icon' => 'calendar-day', 'canvas' => 'dailyRevenueChart'],
        'monthlyRevenueCard' => ['title' => 'Doanh thu theo tháng', 'theme' => 'info', 'icon' => 'chart-bar', 'canvas' => 'monthlyRevenueChart'],
        'yearlyRevenueCard' => ['title' => 'Doanh thu theo năm', 'theme' => 'success', 'icon' => 'calendar-alt', 'canvas' => 'yearlyRevenueChart'],
        'dailyOrderCard' => ['title' => 'Đơn hàng theo ngày', 'theme' => 'dark', 'icon' => 'calendar-day', 'canvas' => 'dailyOrderChart'],
        'monthlyOrderCard' => ['title' => 'Đơn hàng theo tháng', 'theme' => 'cyan', 'icon' => 'calendar', 'canvas' => 'monthlyOrderChart'],
        'yearlyOrderCard' => ['title' => 'Đơn hàng theo năm', 'theme' => 'warning', 'icon' => 'calendar-alt', 'canvas' => 'yearlyOrderChart'],
        'monthlyUserCard' => ['title' => 'Khách hàng mới theo tháng', 'theme' => 'indigo', 'icon' => 'user-plus', 'canvas' => 'monthlyUserChart'],
        'booksSoldCard' => ['title' => 'Sách đã bán theo ngày', 'theme' => 'orange', 'icon' => 'book', 'canvas' => 'booksSoldChart'],
        'booksCreatedCard' => ['title' => 'Sách được thêm mới theo tháng', 'theme' => 'purple', 'icon' => 'plus-square', 'canvas' => 'booksCreatedChart'],
        'booksImportedCard' => ['title' => 'Sách nhập kho theo tháng', 'theme' => 'brown', 'icon' => 'truck-loading', 'canvas' => 'booksImportedChart'],
    ] as $id => $cfg)
        <div class="equal-height" id="{{ $id }}" style="display: {{ $loop->first ? 'block' : 'none' }};">
            <x-adminlte-card title="{{ $cfg['title'] }}" theme="{{ $cfg['theme'] }}" icon="fas fa-{{ $cfg['icon'] }}">
                <canvas id="{{ $cfg['canvas'] }}"></canvas>
            </x-adminlte-card>
        </div>
    @endforeach

    {{-- Pie chart toàn chiều rộng nhưng giới hạn cao --}}
    <div class="equal-height">
        <x-adminlte-card title="Tỷ lệ trạng thái đơn hàng" theme="teal" icon="fas fa-chart-pie">
            <canvas id="orderStatusChart"></canvas>
        </x-adminlte-card>
    </div>

</div>

{{-- Biểu đồ top sách và người dùng --}}
<div class="col-md">
    <x-adminlte-card title="Top 20 sách bán ra" theme="success" icon="fas fa-book">
        <div style="overflow-x: auto;">
            <canvas id="topProductsChart" style="min-width: 1500px; height: 400px;"></canvas>
        </div>
    </x-adminlte-card>
</div>

<div class="col-md">
    <x-adminlte-card title="Top 20 Khách hàng chi tiêu nhiều" theme="warning" icon="fas fa-user-tie">
        <div style="overflow-x: auto;">
            <canvas id="topUsersChart" style="min-width: 1500px; height: 400px;"></canvas>
        </div>
    </x-adminlte-card>
</div>

<div class="mb-4">
    <a href="{{ route('admin.dashboard.export') }}" target="_blank" class="btn btn-danger">
        <i class="fas fa-file-pdf"></i> Xuất PDF báo cáo
    </a>
</div>
@stop

@push('css')
<style>
    .row.flex-wrap {
        display: flex;
        flex-wrap: wrap;
        margin-left: -10px;
        margin-right: -10px;
    }

    .equal-height {
        width: 50%;
        padding: 10px;
        box-sizing: border-box;
    }

    .equal-height.w-100 {
        width: 100% !important;
    }

    .equal-height > .card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .equal-height .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .equal-height canvas {
        flex-grow: 1;
        width: 100% !important;
        max-height: 400px;
        object-fit: contain;
    }
</style>
@endpush

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
        { id: 'booksCreatedChart', labels: @json($booksCreatedLabels), data: @json($booksCreatedData), label: 'Sách thêm mới', type: 'bar', color: '#6f42c1' },
        { id: 'booksImportedChart', labels: @json($booksImportedLabels), data: @json($booksImportedData), label: 'Sách nhập kho', type: 'bar', color: '#795548' },
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
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        ticks: { maxRotation: 45, minRotation: 45 }
                    }
                }
            }
        });
    });

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

    new Chart(document.getElementById('topProductsChart'), {
        type: 'bar',
        data: {
            labels: @json($topProductsLabels),
            datasets: [{
                label: 'Số lượng bán',
                data: @json($topProductsData),
                backgroundColor: '#28a745aa'
            }]
        },
        options: {
            indexAxis: 'x',
            responsive: false,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { x: { ticks: { autoSkip: false } } }
        }
    });

    new Chart(document.getElementById('topUsersChart'), {
        type: 'bar',
        data: {
            labels: @json($topUsersLabels),
            datasets: [{
                label: 'Tổng chi tiêu',
                data: @json($topUsersData),
                backgroundColor: '#ffc107aa'
            }]
        },
        options: {
            indexAxis: 'x',
            responsive: false,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { x: { ticks: { autoSkip: false } } }
        }
    });

    function showChart(cardId) {
        const chartIds = [
            'dailyRevenueCard', 'monthlyRevenueCard', 'yearlyRevenueCard',
            'dailyOrderCard', 'monthlyOrderCard', 'yearlyOrderCard',
            'monthlyUserCard', 'booksSoldCard', 'booksCreatedCard', 'booksImportedCard'
        ];
        chartIds.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.style.display = id === cardId ? 'block' : 'none';
        });
    }
</script>
@endpush

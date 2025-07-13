<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Báo cáo thống kê</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        h2, h4 { text-align: center; margin-top: 30px; }
    </style>
</head>
<body>
    <h2>BÁO CÁO THỐNG KÊ HỆ THỐNG</h2>

    <table>
        <tr>
            <th>Đơn hàng</th>
            <th>Doanh thu</th>
            <th>Người dùng</th>
            <th>Sản phẩm</th>
            <th>Sách đã bán</th>
            <th>Đánh giá</th>
        </tr>
        <tr>
            <td>{{ $totalOrders }}</td>
            <td>{{ number_format($totalRevenue) }}₫</td>
            <td>{{ $totalUsers }}</td>
            <td>{{ $totalProducts }}</td>
            <td>{{ $totalBooksSold }}</td>
            <td>{{ $totalReviews }}</td>
        </tr>
    </table>

    @php
        use Carbon\Carbon;
        $today = Carbon::now()->format('d/m/Y');
        $startOfWeek = Carbon::now()->startOfWeek()->format('d/m/Y');
        $startOfMonth = Carbon::now()->startOfMonth()->format('d/m/Y');
        $startOfYear = Carbon::now()->startOfYear()->format('d/m/Y');
    @endphp

    <h4>Thống kê sách theo thời gian</h4>
    <ul>
        <li>Sách thêm hôm nay ({{ $today }}): {{ $booksToday }}</li>
        <li>Từ {{ $startOfWeek }} đến {{ $today }}: {{ $booksThisWeek }}</li>
        <li>Từ {{ $startOfMonth }} đến {{ $today }}: {{ $booksThisMonth }}</li>
        <li>Từ {{ $startOfYear }} đến {{ $today }}: {{ $booksThisYear }}</li>
    </ul>

    <h4>Thống kê sách nhập kho</h4>
    <ul>
        <li>Hôm nay ({{ $today }}): {{ $nhapToday }}</li>
        <li>Từ {{ $startOfWeek }} đến {{ $today }}: {{ $nhapThisWeek }}</li>
        <li>Từ {{ $startOfMonth }} đến {{ $today }}: {{ $nhapThisMonth }}</li>
        <li>Từ {{ $startOfYear }} đến {{ $today }}: {{ $nhapThisYear }}</li>
    </ul>

    <h4>Thống kê doanh thu theo ngày (gần đây)</h4>
    <table>
        <tr>
            <th>Ngày</th>
            @foreach($dailyRevenueLabels as $label)
                <td>{{ $label }}</td>
            @endforeach
        </tr>
        <tr>
            <th>Doanh thu</th>
            @foreach($dailyRevenueData as $value)
                <td>{{ number_format($value) }}₫</td>
            @endforeach
        </tr>
    </table>

    <h4>Thống kê doanh thu theo tháng</h4>
    <table>
        <tr>
            <th>Tháng</th>
            @foreach($labels as $label)
                <td>{{ $label }}</td>
            @endforeach
        </tr>
        <tr>
            <th>Doanh thu</th>
            @foreach($data as $value)
                <td>{{ number_format($value) }}₫</td>
            @endforeach
        </tr>
    </table>

    <h4>Thống kê doanh thu theo năm</h4>
    <table>
        <tr>
            <th>Năm</th>
            @foreach($yearLabels as $label)
                <td>{{ $label }}</td>
            @endforeach
        </tr>
        <tr>
            <th>Doanh thu</th>
            @foreach($yearlyRevenueData as $value)
                <td>{{ number_format($value) }}₫</td>
            @endforeach
        </tr>
    </table>

    <h4>Thống kê số đơn hàng theo ngày</h4>
    <table>
        <tr>
            <th>Ngày</th>
            @foreach($dailyOrderLabels as $label)
                <td>{{ $label }}</td>
            @endforeach
        </tr>
        <tr>
            <th>Số đơn</th>
            @foreach($dailyOrderData as $value)
                <td>{{ $value }}</td>
            @endforeach
        </tr>
    </table>

    <h4>Thống kê số đơn hàng theo tháng</h4>
    <table>
        <tr>
            <th>Tháng</th>
            @foreach($monthlyOrderLabels as $label)
                <td>{{ $label }}</td>
            @endforeach
        </tr>
        <tr>
            <th>Số đơn</th>
            @foreach($monthlyOrderData as $value)
                <td>{{ $value }}</td>
            @endforeach
        </tr>
    </table>

    <h4>Thống kê số đơn hàng theo năm</h4>
    <table>
        <tr>
            <th>Năm</th>
            @foreach($yearLabels as $label)
                <td>{{ $label }}</td>
            @endforeach
        </tr>
        <tr>
            <th>Số đơn</th>
            @foreach($yearlyOrderData as $value)
                <td>{{ $value }}</td>
            @endforeach
        </tr>
    </table>

    <p style="text-align: right;">Ngày in: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn #ORD-{{ $donhang->NgayLap->format('Y') }}-{{ $donhang->MaHoaDon }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            line-height: 1.6;
            margin: 30px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            background-color: #3c8dbc;
            color: #fff;
            padding: 10px;
            margin: 0;
        }
        .box {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
        }
        .box h4 {
            margin-top: 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>HÓA ĐƠN BÁN SÁCH</h2>
        <p>#ORD-{{ $donhang->NgayLap->format('Y') }}-{{ $donhang->MaHoaDon }}</p>
    </div>

    <div class="box">
        <h4>Thông tin khách hàng</h4>
        <p><strong>Khách hàng:</strong> {{ $donhang->khachhang->Ho . ' ' . $donhang->khachhang->Ten }}</p>
        <p><strong>Ngày đặt:</strong> {{ $donhang->NgayLap->format('H:i d/m/Y') }}</p>
        <p><strong>Địa chỉ:</strong> {{ $donhang->DiaChi }}</p>
        <p><strong>SĐT:</strong> {{ $donhang->SoDienThoai }}</p>
        <p><strong>Ghi chú:</strong> {{ $donhang->GhiChu ?? 'Không có' }}</p>
    </div>

    <div class="box">
        <h4>Danh sách sản phẩm</h4>
        <table>
            <thead>
                <tr>
                    <th>Tên sách</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
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

        <p class="total">Tổng cộng: {{ number_format($donhang->TongTien) }}₫</p>
        <p><strong>Trạng thái:</strong> {{ $donhang->TrangThai }}</p>
        <p><strong>Thanh toán:</strong>
            @php
                echo $donhang->PT_ThanhToan == 1
                    ? 'Thanh toán khi nhận hàng (COD)'
                    : ($donhang->PT_ThanhToan == 2
                        ? 'Thanh toán VNPay'
                        : 'Không xác định');
            @endphp
        </p>
        <p><strong>Tình trạng thanh toán:</strong>
            @if ($donhang->PT_ThanhToan == 2)
                Đã thanh toán
            @elseif ($donhang->PT_ThanhToan == 1 && $donhang->TrangThai == 'Hoàn tất')
                Đã thanh toán
            @else
                Chưa thanh toán
            @endif
        </p>
    </div>

    <p style="text-align: center; margin-top: 50px;">
        Cảm ơn quý khách đã mua hàng
    </p>
</body>
</html>

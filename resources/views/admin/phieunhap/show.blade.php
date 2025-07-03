@extends('adminlte::page')

@section('title', 'Chi tiết Phiếu Nhập')

@section('content_header')
    <h1>Chi tiết Phiếu Nhập #{{ $phieuNhap->MaPhieuNhap }}</h1>
@stop

@section('content')
    <p><strong>Ngày nhập:</strong> {{ $phieuNhap->NgayNhap }}</p>
    <p><strong>Người nhập:</strong>
        {{ optional($phieuNhap->nguoi_nhap)->Ho }} {{ optional($phieuNhap->nguoi_nhap)->Ten }}
    </p>
    <p><strong>Ghi chú:</strong> {{ $phieuNhap->GhiChu }}</p>

    <h5>Chi tiết sách:</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sách</th>
                <th>Số lượng</th>
                <th>Giá nhập</th>
                <th>Giá bán hiện tại</th>

            </tr>
        </thead>
        <tbody>
            @php $tongTien = 0; @endphp
            @foreach($phieuNhap->chi_tiet as $item)
                @php
                    $thanhTien = $item->SoLuong * $item->DonGia;
                    $tongTien += $thanhTien;
                @endphp
                <tr>
                    <td>{{ $item->sach->TenSach ?? 'Không tìm thấy' }}</td>
                    <td>{{ $item->SoLuong }}</td>
                    <td>{{ number_format($item->DonGia) }}₫</td>
                    <td>{{ number_format($item->sach->GiaBan ?? 0) }}₫</td>
              
                </tr>
            @endforeach
        </tbody>

    </table>
@stop

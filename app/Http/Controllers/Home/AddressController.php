<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use App\Models\TinhThanh;
use App\Models\QuanHuyen;
use App\Models\PhuongXa;
use App\Models\DiaChiNhanHang;
use App\Models\CartHold;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class AddressController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ten_nguoi_nhan' => 'required|string|max:255',
            'so_dien_thoai' => 'required|regex:/^[0-9]{10}$/',
            'tinh_thanh_id' => 'required|exists:tinh_thanhs,id',
            'quan_huyen_id' => 'required|exists:quan_huyens,id',
            'phuong_xa_id' => 'required|exists:phuong_xas,id',
            'dia_chi_cu_the' => 'required|string|max:255',
            'mac_dinh' => 'nullable|boolean',
        ]);

        $address = new Address();
        $address->khachhang_id = auth()->id();
        $address->ten_nguoi_nhan = $validated['ten_nguoi_nhan'];
        $address->so_dien_thoai = $validated['so_dien_thoai'];
        $address->tinh_thanh_id = $validated['tinh_thanh_id'];
        $address->quan_huyen_id = $validated['quan_huyen_id'];
        $address->phuong_xa_id = $validated['phuong_xa_id'];
        $address->dia_chi_cu_the = $validated['dia_chi_cu_the'];
        $address->mac_dinh = $request->has('mac_dinh');

        if ($address->mac_dinh) {
            Address::where('MaKhachHang', auth()->id())->update(['mac_dinh' => false]);
        }

        $address->save();

        return redirect()->back()->with('success', 'Thêm địa chỉ thành công!');
    }
}

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

        $userId = auth()->id();

        // Nếu chọn làm mặc định thì reset địa chỉ cũ
        if ($request->has('mac_dinh')) {
            DiaChiNhanHang::where('khachhang_id', $userId)->update(['mac_dinh' => false]);
        }

        // Tạo địa chỉ mới
        $address = new DiaChiNhanHang([
            'khachhang_id' => $userId,
            'ten_nguoi_nhan' => $validated['ten_nguoi_nhan'],
            'so_dien_thoai' => $validated['so_dien_thoai'],
            'tinh_thanh_id' => $validated['tinh_thanh_id'],
            'quan_huyen_id' => $validated['quan_huyen_id'],
            'phuong_xa_id' => $validated['phuong_xa_id'],
            'dia_chi_cu_the' => $validated['dia_chi_cu_the'],
            'mac_dinh' => $request->boolean('mac_dinh'),
        ]);

        $address->save();

        return redirect()->back()->with('success', 'Thêm địa chỉ thành công!');
    }
    public function setDefault($id)
    {
        $userId = auth()->id();
        $address = DiaChiNhanHang::where('id', $id)
            ->where('khachhang_id', $userId)
            ->firstOrFail();

        // Bỏ mặc định tất cả
        DiaChiNhanHang::where('khachhang_id', $userId)->update(['mac_dinh' => false]);

        // Đặt địa chỉ hiện tại làm mặc định
        $address->mac_dinh = true;
        $address->save();

        return redirect()->back()->with('success', 'Cập nhật địa chỉ mặc định thành công!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'ten_nguoi_nhan' => 'required|string|max:255',
            'so_dien_thoai' => 'required|regex:/^[0-9]{10}$/',
            'tinh_thanh_id' => 'required|exists:tinh_thanhs,id',
            'quan_huyen_id' => 'required|exists:quan_huyens,id',
            'phuong_xa_id' => 'required|exists:phuong_xas,id',
            'dia_chi_cu_the' => 'required|string|max:255',
        ]);

        $address = DiaChiNhanHang::where('id', $id)
            ->where('khachhang_id', auth()->id())
            ->firstOrFail();

        $address->update($validated);

        return redirect()->back()->with('success', 'Cập nhật địa chỉ thành công!');
    }
    public function destroy($id)
    {
        $userId = auth()->id();
        $address = DiaChiNhanHang::where('id', $id)
            ->where('khachhang_id', $userId)
            ->firstOrFail();

        $address->delete();

        return redirect()->back()->with('success', 'Xóa địa chỉ thành công!');
    }

}

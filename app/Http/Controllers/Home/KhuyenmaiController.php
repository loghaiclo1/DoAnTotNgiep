<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhuyenMai;

class KhuyenMaiController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'order_total' => 'required|numeric|min:0',
        ]);

        $code = $request->code;
        $orderTotal = $request->order_total;

        // Nếu đã có mã áp dụng
        if (session()->has('promo')) {
            $currentPromo = session('promo');
            if ($currentPromo['MaCode'] === $code) {
                return response()->json([
                    'error' => 'Mã đã được áp dụng.'
                ], 409); // Conflict
            } else {
                return response()->json([
                    'error' => 'Bạn đã áp dụng mã khuyến mãi. Vui lòng hủy trước khi thêm mã mới.'
                ], 409); // Conflict
            }
        }

        $khuyenMai = KhuyenMai::where('MaCode', $code)->first();

        if (!$khuyenMai) {
            return response()->json([
                'error' => 'Không có mã phù hợp.'
            ], 404);
        }

        if (!$khuyenMai->isValid()) {
            return response()->json([
                'error' => 'Mã không còn hiệu lực.'
            ], 410); // Gone (tùy chọn, có thể giữ 400 nếu không muốn thay)
        }

        $discount = $khuyenMai->calculateDiscount($orderTotal);

        session([
            'promo' => [
                'MaKhuyenMai' => $khuyenMai->MaKhuyenMai,
                'MaCode' => $khuyenMai->MaCode,
                'GiaTri' => $khuyenMai->GiaTri,
                'Kieu' => $khuyenMai->Kieu,
                'discount' => $discount,
            ]
        ]);

        return response()->json([
            'message' => 'Áp dụng mã giảm giá thành công.',
            'discount' => $discount,
            'new_total' => $orderTotal - $discount,
            'code' => $khuyenMai->MaCode,
            'giatri' => $khuyenMai->GiaTri,
            'kieu' => $khuyenMai->Kieu,
        ], 200);
    }

    public function remove(Request $request)
    {
        session()->forget('promo');

        return response()->json([
            'message' => 'Đã hủy mã khuyến mãi.'
        ], 200);
    }
}

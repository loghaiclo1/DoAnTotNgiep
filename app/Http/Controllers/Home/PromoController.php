<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhuyenMai;

class PromoController extends Controller
{
    public function apply(Request $request)
    {
        try {
            $code = trim($request->input('promo_code'));

            // Xoá mã cũ trước khi áp mã mới
            session()->forget('promo');

            $promo = KhuyenMai::where('MaCode', $code)
                ->where('TrangThai', 1)
                ->where('NgayBatDau', '<=', now())
                ->where('NgayKetThuc', '>=', now())
                ->first();

            if (!$promo) {
                return response()->json(['status' => 'error', 'message' => 'Mã không hợp lệ hoặc đã hết hạn.'], 400);
            }

            session()->put('promo', [
                'MaCode' => $promo->MaCode,
                'GiaTri' => $promo->GiaTri,
                'Kieu'   => $promo->Kieu,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Áp dụng mã thành công!', 'promo' => $promo]);

        } catch (\Throwable $e) {
            \Log::error('Lỗi áp dụng mã khuyến mãi: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Đã xảy ra lỗi server.'], 500);
        }
    }
}

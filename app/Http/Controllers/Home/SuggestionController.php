<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Sach;
use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;

class SuggestionController extends Controller
{
    public function getSuggestions()
    {
        $sachGoiY = $this->generateSuggestions();
        return view('homepage.partials.goi-y-sach', compact('sachGoiY'));
    }
//view, không trả về data tách riêng phần logic xử lý dữ liệu
    public function generateSuggestions()
    {
        $sachGoiY = collect();

        if (auth()->check()) {
            $userId = auth()->id();

            $bookIds = \App\Models\ChiTietHoaDon::join('hoadon', 'chitiethoadon.MaHoaDon', '=', 'hoadon.MaHoaDon')
                ->where('hoadon.MaKhachHang', $userId)
                ->orderByDesc('hoadon.created_at')
                ->limit(10)
                ->pluck('chitiethoadon.MaSach');

            $sachGoiY = \App\Models\Sach::whereIn('MaSach', $bookIds)->where('TrangThai', 1)->get();
        }

        if ($sachGoiY->isEmpty()) {
            $mostUsedCategory = \DB::table('sach')
                ->select('category_id', \DB::raw('COUNT(*) as total'))
                ->groupBy('category_id')
                ->orderByDesc('total')
                ->value('category_id');

            if ($mostUsedCategory) {
                $sachGoiY = \App\Models\Sach::where('category_id', $mostUsedCategory)
                    ->where('TrangThai', 1)
                    ->limit(8)
                    ->get();
            }
        }

        if ($sachGoiY->isEmpty()) {
            $topAuthorId = \DB::table('sach')
                ->select('MaTacGia', \DB::raw('COUNT(*) as total'))
                ->groupBy('MaTacGia')
                ->orderByDesc('total')
                ->value('MaTacGia');

            if ($topAuthorId) {
                $sachGoiY = \App\Models\Sach::where('MaTacGia', $topAuthorId)
                    ->where('TrangThai', 1)
                    ->limit(8)
                    ->get();
            }
        }

        if ($sachGoiY->isEmpty()) {
            $bestSellerIds = \DB::table('chitiethoadon')
                ->select('MaSach', \DB::raw('COUNT(*) as so_luong_mua'))
                ->groupBy('MaSach')
                ->orderByDesc('so_luong_mua')
                ->limit(8)
                ->pluck('MaSach');

            $sachGoiY = \App\Models\Sach::whereIn('MaSach', $bestSellerIds)->where('TrangThai', 1)->get();
        }

        return $sachGoiY;
    }
}

<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hoadon;
use App\Models\TinhThanh;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AccountController extends Controller
{
    // Hàm bỏ dấu tiếng Việt
    private function stripUnicode($str)
    {
        $unicode = [
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
        ];

        foreach ($unicode as $nonAccent => $accentGroup) {
            $str = preg_replace("/($accentGroup)/i", $nonAccent, $str);
        }
        return $str;
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $addresses = $user->addresses ?? collect();

        $query = Hoadon::with(['chitiethoadon.sach', 'phuongthucthanhtoan', 'khachhang'])
            ->where('MaKhachHang', $user->MaKhachHang);

        // Xử lý tìm kiếm
        if ($request->filled('order_search')) {
            $rawKeyword = trim($request->input('order_search'));
            $keyword = $this->stripUnicode($rawKeyword);
            $numberOnly = preg_replace('/[^0-9]/', '', $rawKeyword);

            // Lấy ra số đơn hàng nếu có dạng #ORD-xxxx-yy
            preg_match('/(\d{2,})$/', $rawKeyword, $matches);
            $possibleMaHoaDon = $matches[1] ?? $numberOnly;

            // Parse ngày
            try {
                $parsedDate = Carbon::parse($rawKeyword)->format('Y-m-d');
            } catch (\Exception $e) {
                $parsedDate = null;
            }

            $query->where(function ($q) use ($keyword, $rawKeyword, $numberOnly, $possibleMaHoaDon, $parsedDate) {
                $q->where('MaHoaDon', 'like', "%$possibleMaHoaDon%")
                  ->orWhereRaw('CAST(TongTien AS CHAR) LIKE ?', ["%$numberOnly%"]);

                if ($parsedDate) {
                    $q->orWhereDate('NgayLap', $parsedDate);
                }

                $q->orWhereHas('phuongthucthanhtoan', function ($sub) use ($rawKeyword) {
                    $sub->where('TenPhuongThuc', 'like', "%$rawKeyword%");
                });

                $q->orWhereHas('chitiethoadon.sach', function ($sub) use ($keyword, $rawKeyword) {
                    $sub->where(function ($ss) use ($keyword, $rawKeyword) {
                        $ss->whereRaw('LOWER(TenSach) LIKE ?', ["%" . strtolower($rawKeyword) . "%"])
                           ->orWhereRaw('LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
                               TenSach, "á", "a"), "à", "a"), "ả", "a"), "ã", "a"), "ạ", "a"),
                               "â", "a"), "ă", "a"), "é", "e"), "è", "e"), "ẻ", "e")) LIKE ?', ["%" . strtolower($keyword) . "%"]);
                    });
                });
            });
        }

        // Lọc trạng thái
        if ($request->filled('status') && $request->input('status') !== 'Tất Cả Đơn Hàng') {
            $query->where('TrangThai', $request->input('status'));
        }

        $orders = $query->orderByDesc('NgayLap')->get();
        $tinhThanhs = TinhThanh::all();

        // Ghi log
        foreach ($orders as $order) {
            Log::info("Đơn hàng {$order->MaHoaDon}", [
                'MaKhachHang' => $order->MaKhachHang,
                'TongTien' => $order->TongTien,
                'TrangThai' => $order->TrangThai,
                'PT_ThanhToan' => optional($order->phuongthucthanhtoan)->TenPhuongThuc,
                'ChiTiet' => $order->chitiethoadon->map(function ($item) {
                    return [
                        'MaSach' => $item->MaSach,
                        'TenSach' => optional($item->sach)->TenSach,
                        'DonGia' => $item->DonGia,
                        'SoLuong' => $item->SoLuong,
                    ];
                })->toArray(),
            ]);
        }

        if ($request->ajax()) {
            return response()->json(view('homepage.partials.order_list', compact('orders'))->render());
        }

        return view('homepage.account', compact('user', 'orders', 'addresses', 'tinhThanhs'));
    }

    public function getOrderStatus($id)
    {
        $order = Hoadon::find($id);

        if (!$order) {
            return response()->json(['status' => 'not_found'], 404);
        }

        $statusMap = [
            'Đang chờ' => 'processing',
            'Đã xác nhận' => 'confirmed',
            'Đang giao' => 'shipping',
            'Hoàn tất' => 'completed',
            'Đã hủy' => 'cancelled',
        ];

        return response()->json([
            'status' => $order->TrangThai,
            'class' => $statusMap[$order->TrangThai] ?? 'processing'
        ]);
    }
}

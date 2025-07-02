<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hoadon;
use App\Models\TinhThanh;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\DanhGiaSanPham;
use Illuminate\Pagination\LengthAwarePaginator;

class AccountController extends Controller
{
    // Hàm bỏ dấu tiếng Việt
    private function stripUnicode($str)
    {
        $unicode = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
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

           $activeTab = 'orders';

if (
    $request->query('tab') === 'reviews' ||
    $request->has('reviews_ajax') ||
    $request->has('sort')
) {
    $activeTab = 'reviews';
} elseif ($request->query('tab') === 'addresses') {
    $activeTab = 'addresses';
} elseif ($request->query('tab') === 'settings') {
    $activeTab = 'settings';
}

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

        // Lấy sách đã đánh giá
        $reviewedBookIds = DanhGiaSanPham::where('MaKhachHang', $user->MaKhachHang)->pluck('MaSach');

        // Lấy danh sách sách đã mua nhưng chưa đánh giá
        $completedOrders = Hoadon::with('chitiethoadon.sach')
            ->where('MaKhachHang', $user->MaKhachHang)
            ->whereIn('TrangThai', ['Hoàn thành', 'Hoàn tất'])
            ->get();

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;

        $unreviewedBooksCollection = $orders->flatMap(function ($order) use ($reviewedBookIds) {
            return $order->chitiethoadon->filter(function ($item) use ($reviewedBookIds) {
                return !$reviewedBookIds->contains($item->MaSach);
            })->map(function ($item) use ($order) {
                return [
                    'order_id' => $order->MaHoaDon,
                    'order_date' => $order->NgayLap,
                    'book' => $item->sach,
                ];
            });
        })->unique('book.MaSach')->values();

        // ✅ Bọc vào paginator
        $unreviewedBooks = new LengthAwarePaginator(
            $unreviewedBooksCollection->forPage($page, $perPage),
            $unreviewedBooksCollection->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        foreach ($completedOrders as $order) {
            foreach ($order->chitiethoadon as $item) {
                if (!$reviewedBookIds->contains($item->MaSach)) {
                    $unreviewedBooks->push([
                        'order_id' => $order->MaHoaDon,
                        'book' => $item->sach,
                        'quantity' => $item->SoLuong,
                        'order_date' => $order->NgayLap,
                    ]);
                }
            }
        }

        $reviewSort = $request->input('sort');

        $reviewsQuery = DanhGiaSanPham::with('book')
            ->where('MaKhachHang', $user->MaKhachHang);

        // Xử lý sắp xếp theo dropdown
        switch ($reviewSort) {
            case 'high':
                $reviewsQuery->orderBy('SoSao', 'desc');
                break;
            case 'low':
                $reviewsQuery->orderBy('SoSao', 'asc');
                break;
            default: // 'recent' hoặc không có sort
                $reviewsQuery->orderBy('NgayDanhGia', 'desc');
                break;
        }

$reviews = $reviewsQuery->paginate(5)->appends(['tab' => 'reviews']);

        if ($request->ajax()) {
            if ($request->has('reviews_ajax')) {
                return response()->json([
                    'html' => view('homepage.partials.review_list', compact('reviews'))->render(),
                    'sort' => $reviewSort
                ]);
            }

            return response()->json([
                'html' => view('homepage.partials.order_list', compact('orders'))->render()
            ]);
        }

        return view('homepage.account', compact('user', 'orders', 'addresses', 'tinhThanhs', 'reviews', 'unreviewedBooks', 'activeTab'));
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

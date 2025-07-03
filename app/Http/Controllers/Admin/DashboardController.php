<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hoadon;
use App\Models\KhachHang as User;
use App\Models\Book as Sach;
use App\Models\ChiTietHoaDon;
use App\Models\DanhGiaSanPham;
use App\Models\Contact as LienHe; // Assuming you have a Contact model
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Tổng quan
        $totalOrders = Hoadon::count();
        $totalRevenue = Hoadon::where('TrangThai', 'Hoàn tất')->sum('TongTien');
        $totalUsers = User::count();
        $totalProducts = Sach::count();

        // Doanh thu 6 tháng gần nhất
        $orders = Hoadon::select(
                DB::raw("DATE_FORMAT(NgayLap, '%m/%Y') as month"),
                DB::raw("SUM(TongTien) as total")
            )
            ->whereNotNull('NgayLap')
            ->where('TrangThai', 'Hoàn tất')
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
            ->take(6)
            ->get()
            ->reverse();

        $labels = $orders->pluck('month');
        $data = $orders->pluck('total');

        // Thống kê đơn theo trạng thái
        $ordersByStatus = Hoadon::select('TrangThai', DB::raw('count(*) as total'))
            ->groupBy('TrangThai')
            ->pluck('total', 'TrangThai');

        // Thống kê số lượng đơn hàng theo tháng (6 tháng gần nhất)
        $ordersCountByMonth = Hoadon::select(
                DB::raw("DATE_FORMAT(NgayLap, '%m/%Y') as month"),
                DB::raw("COUNT(*) as total_orders")
            )
            ->whereNotNull('NgayLap')
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
            ->take(6)
            ->get()
            ->reverse();

        $orderCountLabels = $ordersCountByMonth->pluck('month');
        $orderCountData = $ordersCountByMonth->pluck('total_orders');

        // Tổng sách đã bán
        $totalBooksSold = ChiTietHoaDon::join('hoadon', 'hoadon.MaHoaDon', '=', 'chitiethoadon.MaHoaDon')
            ->where('hoadon.TrangThai', 'Hoàn tất')
            ->sum('chitiethoadon.SoLuong');

        // Thống kê đánh giá
        $totalReviews = DanhGiaSanPham::count();

        // Tỷ lệ sao đánh giá
        $ratings = DanhGiaSanPham::select('SoSao', DB::raw('COUNT(*) as total'))
            ->groupBy('SoSao')
            ->orderBy('SoSao')
            ->pluck('total', 'SoSao');

        // Thống kê liên hệ mới chưa xử lý
        $pendingContacts = LienHe::where('trang_thai', '0')->count();

        // Thống kê số lượng tài khoản đăng ký theo tháng (6 tháng gần nhất)
        $userRegistrations = User::select(
                DB::raw("DATE_FORMAT(created_at, '%m/%Y') as month"),
                DB::raw("COUNT(*) as total_users")
            )
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
            ->take(6)
            ->get()
            ->reverse();

        $userRegLabels = $userRegistrations->pluck('month');
        $userRegData = $userRegistrations->pluck('total_users');

        // Top 5 sản phẩm bán chạy
        $topProducts = ChiTietHoaDon::select('MaSach', DB::raw('SUM(SoLuong) as total_sold'))
            ->groupBy('MaSach')
            ->orderByDesc('total_sold')
            ->take(5)
            ->with('sach')
            ->get();

        // Top 5 khách hàng chi nhiều nhất
        $topUsers = Hoadon::select('MaKhachHang', DB::raw('SUM(TongTien) as total_spent'), DB::raw('COUNT(*) as orders_count'))
            ->whereNotNull('MaKhachHang')
            ->groupBy('MaKhachHang')
            ->orderByDesc('total_spent')
            ->take(5)
            ->with('khachhang')
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalUsers',
            'totalProducts',
            'labels',
            'data',
            'ordersByStatus',
            'orderCountLabels',
            'orderCountData',
            'totalBooksSold',
            'totalReviews',
            'ratings',
            'pendingContacts',
            'userRegLabels',
            'userRegData',
            'topProducts',
            'topUsers'
        ));
    }
}

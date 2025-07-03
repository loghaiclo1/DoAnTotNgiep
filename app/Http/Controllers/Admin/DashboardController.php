<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hoadon;
use App\Models\KhachHang as User;
use App\Models\Book as Sach;
use App\Models\ChiTietHoaDon;
use App\Models\DanhGiaSanPham;
use App\Models\Contact as LienHe;
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
        $totalBooksSold = ChiTietHoaDon::join('hoadon', 'hoadon.MaHoaDon', '=', 'chitiethoadon.MaHoaDon')
            ->where('hoadon.TrangThai', 'Hoàn tất')
            ->sum('chitiethoadon.SoLuong');
        $totalReviews = DanhGiaSanPham::count();
        $pendingContacts = LienHe::where('trang_thai', '0')->count();

        // Biểu đồ doanh thu theo tháng (6 tháng gần nhất)
        $monthlyRevenue = Hoadon::select(
                DB::raw("DATE_FORMAT(NgayLap, '%m/%Y') as month"),
                DB::raw("SUM(TongTien) as total")
            )
            ->where('TrangThai', 'Hoàn tất')
            ->whereNotNull('NgayLap')
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
            ->take(6)->get()->reverse();
        $labels = $monthlyRevenue->pluck('month');
        $data = $monthlyRevenue->pluck('total');

        // Biểu đồ trạng thái đơn hàng
        $ordersByStatus = Hoadon::select('TrangThai', DB::raw('count(*) as total'))
            ->groupBy('TrangThai')
            ->pluck('total', 'TrangThai');

        // Đơn hàng theo tháng
        $ordersCountByMonth = Hoadon::select(
                DB::raw("DATE_FORMAT(NgayLap, '%m/%Y') as month"),
                DB::raw("COUNT(*) as total_orders")
            )
            ->whereNotNull('NgayLap')
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
            ->take(6)->get()->reverse();
        $orderCountLabels = $ordersCountByMonth->pluck('month');
        $orderCountData = $ordersCountByMonth->pluck('total_orders');

        // Doanh thu theo ngày (7 ngày gần nhất)
        $dailyRevenue = Hoadon::select(
                DB::raw("DATE_FORMAT(NgayLap, '%d/%m') as day"),
                DB::raw("SUM(TongTien) as total")
            )
            ->where('TrangThai', 'Hoàn tất')
            ->whereDate('NgayLap', '>=', now()->subDays(6))
            ->groupBy('day')
            ->orderByRaw("STR_TO_DATE(day, '%d/%m')")
            ->get();
        $dailyRevenueLabels = $dailyRevenue->pluck('day');
        $dailyRevenueData = $dailyRevenue->pluck('total');

        // Doanh thu theo năm (3 năm gần nhất)
        $yearlyRevenue = Hoadon::select(
                DB::raw("YEAR(NgayLap) as year"),
                DB::raw("SUM(TongTien) as total")
            )
            ->where('TrangThai', 'Hoàn tất')
            ->groupBy('year')
            ->orderByDesc('year')
            ->take(3)->get()->reverse();
        $yearLabels = $yearlyRevenue->pluck('year');
        $yearlyRevenueData = $yearlyRevenue->pluck('total');

        // Đơn hàng theo ngày (7 ngày gần nhất)
        $dailyOrders = Hoadon::select(
                DB::raw("DATE_FORMAT(NgayLap, '%d/%m') as day"),
                DB::raw("COUNT(*) as total")
            )
            ->whereDate('NgayLap', '>=', now()->subDays(6))
            ->groupBy('day')
            ->orderByRaw("STR_TO_DATE(day, '%d/%m')")
            ->get();
        $dailyOrderLabels = $dailyOrders->pluck('day');
        $dailyOrderData = $dailyOrders->pluck('total');

        // Đơn hàng theo năm (3 năm gần nhất)
        $yearlyOrders = Hoadon::select(
                DB::raw("YEAR(NgayLap) as year"),
                DB::raw("COUNT(*) as total")
            )
            ->groupBy('year')
            ->orderByDesc('year')
            ->take(3)->get()->reverse();
        $yearlyOrderData = $yearlyOrders->pluck('total');

        // Người dùng mới theo tháng
        $monthlyUser = User::select(
                DB::raw("DATE_FORMAT(created_at, '%m/%Y') as month"),
                DB::raw("COUNT(*) as total")
            )
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
            ->take(6)->get()->reverse();
        $monthlyUserLabels = $monthlyUser->pluck('month');
        $monthlyUserData = $monthlyUser->pluck('total');

        // Sách đã bán theo tháng
        $booksSoldMonthly = ChiTietHoaDon::join('hoadon', 'hoadon.MaHoaDon', '=', 'chitiethoadon.MaHoaDon')
            ->select(
                DB::raw("DATE_FORMAT(hoadon.NgayLap, '%m/%Y') as month"),
                DB::raw("SUM(chitiethoadon.SoLuong) as total")
            )
            ->where('hoadon.TrangThai', 'Hoàn tất')
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
            ->take(6)->get()->reverse();
        $booksSoldLabels = $booksSoldMonthly->pluck('month');
        $booksSoldData = $booksSoldMonthly->pluck('total');

        // Top 5 sản phẩm bán chạy
        $topProducts = ChiTietHoaDon::select('MaSach', DB::raw('SUM(SoLuong) as total_sold'))
            ->groupBy('MaSach')
            ->orderByDesc('total_sold')
            ->take(5)
            ->with('sach')
            ->get();

        // Top 5 khách hàng chi tiêu nhiều nhất
        $topUsers = Hoadon::select('MaKhachHang', DB::raw('SUM(TongTien) as total_spent'), DB::raw('COUNT(*) as orders_count'))
            ->whereNotNull('MaKhachHang')
            ->groupBy('MaKhachHang')
            ->orderByDesc('total_spent')
            ->take(5)
            ->with('khachhang')
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders', 'totalRevenue', 'totalUsers', 'totalProducts', 'totalBooksSold', 'totalReviews', 'pendingContacts',
            'labels', 'data',
            'ordersByStatus',
            'orderCountLabels', 'orderCountData',
            'dailyRevenueLabels', 'dailyRevenueData',
            'yearLabels', 'yearlyRevenueData',
            'dailyOrderLabels', 'dailyOrderData', 'yearlyOrderData',
            'monthlyUserLabels', 'monthlyUserData',
            'booksSoldLabels', 'booksSoldData',
            'topProducts', 'topUsers'
        ));
    }
}

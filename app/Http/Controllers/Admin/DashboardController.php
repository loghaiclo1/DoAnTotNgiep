<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hoadon;
use App\Models\KhachHang as User;
use App\Models\Book as Sach;
use App\Models\ChiTietHoaDon;
use App\Models\DanhGiaSanPham;
use Illuminate\Support\Facades\DB;
use App\Models\ChiTietPhieuNhap;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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

        // Doanh thu theo tháng
        $monthlyRevenue = Hoadon::select(DB::raw("DATE_FORMAT(NgayLap, '%m/%Y') as month"), DB::raw("SUM(TongTien) as total"))
            ->where('TrangThai', 'Hoàn tất')
            ->whereNotNull('NgayLap')
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
            ->take(6)->get()->reverse();
        $labels = $monthlyRevenue->pluck('month');
        $data = $monthlyRevenue->pluck('total');

        // Trạng thái đơn hàng
        $ordersByStatus = Hoadon::select('TrangThai', DB::raw('count(*) as total'))
            ->groupBy('TrangThai')
            ->pluck('total', 'TrangThai');

        // Đơn hàng theo tháng
        $monthlyOrders = Hoadon::select(DB::raw("DATE_FORMAT(NgayLap, '%m/%Y') as month"), DB::raw("COUNT(*) as total_orders"))
            ->whereNotNull('NgayLap')
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
            ->take(6)->get()->reverse();
        $monthlyOrderLabels = $monthlyOrders->pluck('month');
        $monthlyOrderData = $monthlyOrders->pluck('total_orders');

        // Doanh thu theo ngày
        $dailyRevenue = Hoadon::select(
            DB::raw("DATE_FORMAT(NgayLap, '%d/%m/%Y') as day"),
            DB::raw("SUM(TongTien) as total")
        )
        ->where('TrangThai', 'Hoàn tất')
        ->groupBy('day')
        ->orderByRaw("STR_TO_DATE(day, '%d/%m/%Y')")
        ->get();

    $dailyRevenueLabels = $dailyRevenue->pluck('day');
    $dailyRevenueData = $dailyRevenue->pluck('total');

        // Doanh thu theo năm
        $yearlyRevenue = Hoadon::select(DB::raw("YEAR(NgayLap) as year"), DB::raw("SUM(TongTien) as total"))
            ->where('TrangThai', 'Hoàn tất')
            ->groupBy('year')
            ->orderByDesc('year')
            ->take(3)->get()->reverse();
        $yearLabels = $yearlyRevenue->pluck('year');
        $yearlyRevenueData = $yearlyRevenue->pluck('total');

        // Đơn hàng theo ngày
        $dailyOrders = Hoadon::select(
            DB::raw("DATE_FORMAT(NgayLap, '%d/%m/%Y') as day"),
            DB::raw("COUNT(*) as total")
        )
        ->groupBy('day')
        ->orderByRaw("STR_TO_DATE(day, '%d/%m/%Y')")
        ->get();

        $dailyOrderLabels = $dailyOrders->pluck('day');
        $dailyOrderData = $dailyOrders->pluck('total');

        // Đơn hàng theo năm
        $yearlyOrders = Hoadon::select(DB::raw("YEAR(NgayLap) as year"), DB::raw("COUNT(*) as total"))
            ->groupBy('year')
            ->orderByDesc('year')
            ->take(3)->get()->reverse();
        $yearlyOrderData = $yearlyOrders->pluck('total');

        // Người dùng mới theo tháng
        $monthlyUser = User::select(DB::raw("DATE_FORMAT(created_at, '%m/%Y') as month"), DB::raw("COUNT(*) as total"))
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
            ->take(6)->get()->reverse();
        $monthlyUserLabels = $monthlyUser->pluck('month');
        $monthlyUserData = $monthlyUser->pluck('total');

        // Sách đã bán theo tháng
        $booksSoldMonthly = ChiTietHoaDon::join('hoadon', 'hoadon.MaHoaDon', '=', 'chitiethoadon.MaHoaDon')
            ->select(DB::raw("DATE_FORMAT(hoadon.NgayLap, '%m/%Y') as month"), DB::raw("SUM(chitiethoadon.SoLuong) as total"))
            ->where('hoadon.TrangThai', 'Hoàn tất')
            ->whereNotNull('hoadon.NgayLap')
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
            ->take(6)->get()->reverse();
        $booksSoldLabels = $booksSoldMonthly->pluck('month');
        $booksSoldData = $booksSoldMonthly->pluck('total');

        // Sách thêm mới theo tháng
        $booksCreated = Sach::select(DB::raw("DATE_FORMAT(created_at, '%m/%Y') as month"), DB::raw("COUNT(*) as total"))
            ->whereNotNull('created_at')
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
            ->take(6)->get()->reverse();
        $booksCreatedLabels = $booksCreated->pluck('month');
        $booksCreatedData = $booksCreated->pluck('total');

        // Sách nhập kho theo tháng
        $booksImported = ChiTietPhieuNhap::select(DB::raw("DATE_FORMAT(created_at, '%m/%Y') as month"), DB::raw("SUM(SoLuong) as total"))
            ->whereNotNull('created_at')
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
            ->take(6)->get()->reverse();
        $booksImportedLabels = $booksImported->pluck('month');
        $booksImportedData = $booksImported->pluck('total');

        // Top 20 sản phẩm bán chạy
        $topProducts = ChiTietHoaDon::select('chitiethoadon.MaSach', DB::raw('SUM(chitiethoadon.SoLuong) as total_sold'))
        ->join('hoadon', 'hoadon.MaHoaDon', '=', 'chitiethoadon.MaHoaDon')
        ->where('hoadon.TrangThai', 'Hoàn tất')
        ->groupBy('chitiethoadon.MaSach')
        ->orderByDesc('total_sold')
        ->with('sach')
        ->take(20)->get();

        $topProductsLabels = $topProducts->pluck('sach.TenSach')->map(fn($n) => $n ?? 'Không rõ');
        $topProductsData = $topProducts->pluck('total_sold');

        // Top 20khách hàng chi tiêu nhiều nhất
        $topUsers = Hoadon::select('MaKhachHang', DB::raw('SUM(TongTien) as total_spent'), DB::raw('COUNT(*) as orders_count'))
        ->whereNotNull('MaKhachHang')
        ->where('TrangThai', 'Hoàn tất')
        ->groupBy('MaKhachHang')
        ->orderByDesc('total_spent')
        ->with('khachhang')
        ->take(20)->get();

        $topUsersLabels = $topUsers->map(fn($u) => trim(optional($u->khachhang)->Ho . ' ' . optional($u->khachhang)->Ten) ?: 'Ẩn danh');
        $topUsersData = $topUsers->pluck('total_spent');

        // Sách thêm mới & nhập kho theo thời gian
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();
        $thisYear = Carbon::now()->startOfYear();
        $booksToday = Sach::whereDate('created_at', $today)->count();
        $booksThisWeek = Sach::whereBetween('created_at', [$thisWeek, now()])->count();
        $booksThisMonth = Sach::whereBetween('created_at', [$thisMonth, now()])->count();
        $booksThisYear = Sach::whereBetween('created_at', [$thisYear, now()])->count();
        $nhapToday = ChiTietPhieuNhap::whereDate('created_at', $today)->sum('SoLuong');
        $nhapThisWeek = ChiTietPhieuNhap::whereBetween('created_at', [$thisWeek, now()])->sum('SoLuong');
        $nhapThisMonth = ChiTietPhieuNhap::whereBetween('created_at', [$thisMonth, now()])->sum('SoLuong');
        $nhapThisYear = ChiTietPhieuNhap::whereBetween('created_at', [$thisYear, now()])->sum('SoLuong');

        return view('admin.dashboard', compact(
            'totalOrders', 'totalRevenue', 'totalUsers', 'totalProducts', 'totalBooksSold', 'totalReviews',
            'labels', 'data', 'ordersByStatus',
            'monthlyOrderLabels', 'monthlyOrderData',
            'dailyRevenueLabels', 'dailyRevenueData',
            'yearLabels', 'yearlyRevenueData',
            'dailyOrderLabels', 'dailyOrderData', 'yearlyOrderData',
            'monthlyUserLabels', 'monthlyUserData',
            'booksSoldLabels', 'booksSoldData',
            'booksCreatedLabels', 'booksCreatedData',
            'booksImportedLabels', 'booksImportedData',
            'topProducts', 'topUsers',
            'topProductsLabels', 'topProductsData', 'topUsersLabels', 'topUsersData',
            'booksToday', 'booksThisWeek', 'booksThisMonth', 'booksThisYear',
            'nhapToday', 'nhapThisWeek', 'nhapThisMonth', 'nhapThisYear'
        ));
    }
    public function exportPDF()
{
    $totalOrders = Hoadon::count();
    $totalRevenue = Hoadon::where('TrangThai', 'Hoan tat')->sum('TongTien');
    $totalUsers = User::count();
    $totalProducts = Sach::count();
    $totalBooksSold = ChiTietHoaDon::join('hoadon', 'hoadon.MaHoaDon', '=', 'chitiethoadon.MaHoaDon')
        ->where('hoadon.TrangThai', 'Hoan tat')
        ->sum('chitiethoadon.SoLuong');
    $totalReviews = DanhGiaSanPham::count();


    $monthlyRevenue = Hoadon::select(DB::raw("DATE_FORMAT(NgayLap, '%m/%Y') as month"), DB::raw("SUM(TongTien) as total"))
        ->where('TrangThai', 'Hoan tat')
        ->whereNotNull('NgayLap')
        ->groupBy('month')
        ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
        ->take(6)->get()->reverse();
    $labels = $monthlyRevenue->pluck('month');
    $data = $monthlyRevenue->pluck('total');

    $ordersByStatus = Hoadon::select('TrangThai', DB::raw('count(*) as total'))
        ->groupBy('TrangThai')
        ->pluck('total', 'TrangThai');

    $monthlyOrders = Hoadon::select(DB::raw("DATE_FORMAT(NgayLap, '%m/%Y') as month"), DB::raw("COUNT(*) as total_orders"))
        ->whereNotNull('NgayLap')
        ->groupBy('month')
        ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
        ->take(6)->get()->reverse();
    $monthlyOrderLabels = $monthlyOrders->pluck('month');
    $monthlyOrderData = $monthlyOrders->pluck('total_orders');

    $dailyRevenue = Hoadon::select(DB::raw("DATE_FORMAT(NgayLap, '%d/%m/%Y') as day"), DB::raw("SUM(TongTien) as total"))
        ->where('TrangThai', 'Hoan tat')
        ->whereDate('NgayLap', '>=', now()->subDays(6))
        ->groupBy('day')
        ->orderByRaw("STR_TO_DATE(day, '%d/%m/%Y')")
        ->get();
        $dates = collect();
        for ($i = 6; $i >= 0; $i--) {
            $dates->push(Carbon::today()->subDays($i)->format('d/m/Y'));
        }

        $revenuePerDay = Hoadon::select(DB::raw("DATE_FORMAT(NgayLap, '%d/%m/%Y') as day"), DB::raw("SUM(TongTien) as total"))
            ->where('TrangThai', 'Hoan tat')
            ->whereDate('NgayLap', '>=', Carbon::today()->subDays(6))
            ->groupBy('day')->pluck('total', 'day');

        $dailyRevenueLabels = $dates;
        $dailyRevenueData = $dates->map(fn($d) => $revenuePerDay[$d] ?? 0);

    $yearlyRevenue = Hoadon::select(DB::raw("YEAR(NgayLap) as year"), DB::raw("SUM(TongTien) as total"))
        ->where('TrangThai', 'Hoan tat')
        ->groupBy('year')
        ->orderByDesc('year')
        ->take(3)->get()->reverse();
    $yearLabels = $yearlyRevenue->pluck('year');
    $yearlyRevenueData = $yearlyRevenue->pluck('total');

    $dailyOrders = Hoadon::select(DB::raw("DATE_FORMAT(NgayLap, '%d/%m/%Y') as day"), DB::raw("COUNT(*) as total"))
        ->whereDate('NgayLap', '>=', now()->subDays(6))
        ->groupBy('day')
        ->orderByRaw("STR_TO_DATE(day, '%d/%m/%Y')")
        ->get();
    $dailyOrderLabels = $dailyOrders->pluck('day');
    $dailyOrderData = $dailyOrders->pluck('total');
    $dates = $dailyOrderLabels; // cùng nhãn ngày với dailyOrderData

    $dailyOrderSuccess = collect();
    $dailyOrderFailed = collect();
    $dailyOrderCancelled = collect();

    foreach ($dates as $dateStr) {
        $date = Carbon::createFromFormat('d/m/Y', $dateStr)->format('Y-m-d');
        $dailyOrderSuccess->push(
            Hoadon::whereDate('NgayLap', $date)->where('TrangThai', 'Hoan tat')->count()
        );
        $dailyOrderFailed->push(
            Hoadon::whereDate('NgayLap', $date)->where('TrangThai', 'That bai')->count()
        );
        $dailyOrderCancelled->push(
            Hoadon::whereDate('NgayLap', $date)->where('TrangThai', 'Da huy')->count()
        );
    }
    $yearlyOrders = Hoadon::select(DB::raw("YEAR(NgayLap) as year"), DB::raw("COUNT(*) as total"))
        ->groupBy('year')
        ->orderByDesc('year')
        ->take(3)->get()->reverse();
    $yearlyOrderData = $yearlyOrders->pluck('total');

    $monthlyUser = User::select(DB::raw("DATE_FORMAT(created_at, '%m/%Y') as month"), DB::raw("COUNT(*) as total"))
        ->groupBy('month')
        ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
        ->take(6)->get()->reverse();
    $monthlyUserLabels = $monthlyUser->pluck('month');
    $monthlyUserData = $monthlyUser->pluck('total');

    $booksSoldMonthly = ChiTietHoaDon::join('hoadon', 'hoadon.MaHoaDon', '=', 'chitiethoadon.MaHoaDon')
        ->select(DB::raw("DATE_FORMAT(hoadon.NgayLap, '%m/%Y') as month"), DB::raw("SUM(chitiethoadon.SoLuong) as total"))
        ->where('hoadon.TrangThai', 'Hoan tat')
        ->whereNotNull('hoadon.NgayLap')
        ->groupBy('month')
        ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
        ->take(6)->get()->reverse();
    $booksSoldLabels = $booksSoldMonthly->pluck('month');
    $booksSoldData = $booksSoldMonthly->pluck('total');

    $booksCreated = Sach::select(DB::raw("DATE_FORMAT(created_at, '%m/%Y') as month"), DB::raw("COUNT(*) as total"))
        ->whereNotNull('created_at')
        ->groupBy('month')
        ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
        ->take(6)->get()->reverse();
    $booksCreatedLabels = $booksCreated->pluck('month');
    $booksCreatedData = $booksCreated->pluck('total');

    $booksImported = ChiTietPhieuNhap::select(DB::raw("DATE_FORMAT(created_at, '%m/%Y') as month"), DB::raw("SUM(SoLuong) as total"))
        ->whereNotNull('created_at')
        ->groupBy('month')
        ->orderByRaw("STR_TO_DATE(CONCAT('01/', month), '%d/%m/%Y') DESC")
        ->take(6)->get()->reverse();
    $booksImportedLabels = $booksImported->pluck('month');
    $booksImportedData = $booksImported->pluck('total');

    $topProducts = ChiTietHoaDon::join('hoadon', 'hoadon.MaHoaDon', '=', 'chitiethoadon.MaHoaDon')
        ->join('sach', 'sach.MaSach', '=', 'chitiethoadon.MaSach')
        ->select('sach.TenSach', DB::raw('SUM(chitiethoadon.SoLuong) as total_sold'))
        ->where('hoadon.TrangThai', 'Hoan tat')
        ->groupBy('sach.TenSach')
        ->orderByDesc('total_sold')
        ->take(20)
        ->get();
    $topProductsLabels = $topProducts->pluck('TenSach');
    $topProductsData = $topProducts->pluck('total_sold');


    $topUsers = Hoadon::join('khachhang', 'khachhang.MaKhachHang', '=', 'hoadon.MaKhachHang')
        ->select(DB::raw("CONCAT(khachhang.Ho, ' ', khachhang.Ten) as full_name"), DB::raw('SUM(hoadon.TongTien) as total_spent'))
        ->where('hoadon.TrangThai', 'Hoan tat')
        ->groupBy('full_name')
        ->orderByDesc('total_spent')
        ->take(20)
        ->get();
    $topUsersLabels = $topUsers->pluck('full_name');
    $topUsersData = $topUsers->pluck('total_spent');

    $today = Carbon::today();
    $thisWeek = Carbon::now()->startOfWeek();
    $thisMonth = Carbon::now()->startOfMonth();
    $thisYear = Carbon::now()->startOfYear();
    $booksToday = Sach::whereDate('created_at', $today)->count();
    $booksThisWeek = Sach::whereBetween('created_at', [$thisWeek, now()])->count();
    $booksThisMonth = Sach::whereBetween('created_at', [$thisMonth, now()])->count();
    $booksThisYear = Sach::whereBetween('created_at', [$thisYear, now()])->count();
    $nhapToday = ChiTietPhieuNhap::whereDate('created_at', $today)->sum('SoLuong');
    $nhapThisWeek = ChiTietPhieuNhap::whereBetween('created_at', [$thisWeek, now()])->sum('SoLuong');
    $nhapThisMonth = ChiTietPhieuNhap::whereBetween('created_at', [$thisMonth, now()])->sum('SoLuong');
    $nhapThisYear = ChiTietPhieuNhap::whereBetween('created_at', [$thisYear, now()])->sum('SoLuong');

    return Pdf::loadView('admin.dashboard.export', compact(
        'totalOrders', 'totalRevenue', 'totalUsers', 'totalProducts', 'totalBooksSold', 'totalReviews',
        'labels', 'data', 'ordersByStatus',
        'monthlyOrderLabels', 'monthlyOrderData',
        'dailyRevenueLabels', 'dailyRevenueData',
        'yearLabels', 'yearlyRevenueData',
        'dailyOrderLabels', 'dailyOrderData', 'yearlyOrderData',
        'monthlyUserLabels', 'monthlyUserData',
        'booksSoldLabels', 'booksSoldData',
        'booksCreatedLabels', 'booksCreatedData',
        'booksImportedLabels', 'booksImportedData',
        'topProductsLabels', 'topProductsData', 'topUsersLabels', 'topUsersData',
        'booksToday', 'booksThisWeek', 'booksThisMonth', 'booksThisYear',
        'nhapToday', 'nhapThisWeek', 'nhapThisMonth', 'nhapThisYear','dailyOrderSuccess', 'dailyOrderFailed', 'dailyOrderCancelled'
    ))->setPaper('a4', 'portrait')->download('bao-cao-thong-ke.pdf');
}

}

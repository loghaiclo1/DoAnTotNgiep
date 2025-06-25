<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hoadon;
use App\Events\OrderStatusUpdated;
use Termwind\Components\Hr;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Hoadon::with('khachhang');

        if ($search = $request->input('keyword')) {
            $query->where('MaHoaDon', 'like', "%{$search}%")
                ->orWhereHas('khachhang', function ($q) use ($search) {
                    $q->where('Ho', 'like', "%{$search}%")
                        ->orWhere('Ten', 'like', "%{$search}%");
                });
        }

        if ($status = $request->input('status')) {
            $query->where('TrangThai', $status);
        }

        $sort = $request->input('sort');
        if ($sort === 'date_asc') {
            $query->orderBy('NgayLap', 'asc');
        } elseif ($sort === 'date_desc') {
            $query->orderBy('NgayLap', 'desc');
        } elseif ($sort === 'price_asc') {
            $query->orderBy('TongTien', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('TongTien', 'desc');
        } else {
            $query->orderBy('NgayLap', 'desc');
        }

        $perPage = (int) $request->input('per_page', 10); // mặc định 10
        $orders = $query->paginate($perPage)->appends($request->query());

        return view('admin.orders.index', compact('orders'));
    }


    public function show($id)
    {
        $donhang = Hoadon::with(['khachhang', 'chitiethoadon.sach'])->findOrFail($id);
        return view('admin.orders.show', compact('donhang'));
    }

    public function update(Request $request, $id)
    {
        $donhang = Hoadon::where('MaHoaDon', $id)->firstOrFail();

        $trangThaiHienTai = $donhang->TrangThai;
        $trangThaiMoi = $request->TrangThai;

        // Danh sách trạng thái theo thứ tự logic
        $thuTuTrangThai = [
            'Đang chờ',
            'Đã xác nhận',
            'Đang giao hàng',
            'Hoàn tất',
        ];

        // Nếu admin chọn Hủy đơn, cho phép hủy ở bất kỳ bước nào
        if ($trangThaiMoi === 'Hủy đơn') {
            $donhang->TrangThai = $trangThaiMoi;
            $donhang->save();
            return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công.');
        }

        // Nếu trạng thái hiện tại là Hủy đơn thì không được cập nhật nữa
        if ($trangThaiHienTai === 'Hủy đơn') {
            return redirect()->back()->with('error', 'Không thể cập nhật đơn hàng đã bị hủy.');
        }

        // Kiểm tra nếu bỏ qua bước (VD: từ "Đang chờ" sang "Đang giao hàng")
        $indexCu = array_search($trangThaiHienTai, $thuTuTrangThai);
        $indexMoi = array_search($trangThaiMoi, $thuTuTrangThai);

        if ($indexCu === false || $indexMoi === false) {
            return redirect()->back()->with('error', 'Trạng thái không hợp lệ.');
        }

        if ($indexMoi > $indexCu + 1) {
            $tenTrangThaiKeTiep = $thuTuTrangThai[$indexCu + 1] ?? 'trạng thái tiếp theo';
            return redirect()->back()->with('error', "Bạn chưa cập nhật bước '$tenTrangThaiKeTiep'. Vui lòng thực hiện lần lượt.");
        }

        // Nếu hợp lệ thì cập nhật
        $donhang->TrangThai = $trangThaiMoi;
        $donhang->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    }
}

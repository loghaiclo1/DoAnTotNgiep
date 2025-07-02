<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hoadon;
use App\Events\OrderStatusUpdated;
use Termwind\Components\Hr;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Hoadon::with('khachhang');

        if ($search = $request->input('keyword')) {
            if (preg_match('/^#ORD-(\d{4})-(\d+)$/', $search, $matches)) {
                $year = $matches[1];
                $id = $matches[2];

                $query->whereYear('NgayLap', $year)
                    ->where('MaHoaDon', $id);
            } else {
                $searchClean = ltrim($search, '#');
                $query->where('MaHoaDon', 'like', "%{$searchClean}%")
                    ->orWhereHas('khachhang', function ($q) use ($search) {
                        $q->whereRaw("LOWER(CONCAT(Ho, ' ', Ten)) LIKE ?", ['%' . strtolower($search) . '%'])
                            ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($search) . '%']);
                    });
            }
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
            if ($trangThaiHienTai === 'Hoàn tất') {
                return redirect()->back()->with('error', 'Không thể hủy đơn hàng đã hoàn tất.');
            }
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

        if ($indexMoi < $indexCu) {
            return redirect()->back()->with('error', 'Không thể chuyển về trạng thái trước đó. Vui lòng tiếp tục xử lý.');
        }

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
        event(new OrderStatusUpdated($donhang->MaHoaDon, $donhang->TrangThai));
        \Log::info('Gửi broadcast cho đơn hàng: ' . $donhang->MaHoaDon);
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    }
    public function trackingHtml($id)
    {
        $order = HoaDon::with('chitiethoadon.sach')->findOrFail($id);

        // Xử lý tương tự như trong account.blade.php
        $isCancelled = $order->TrangThai === 'Hủy đơn';
        $trackingSteps = $isCancelled
            ? [
                ['status' => 'Hủy đơn', 'label' => 'Đơn Hàng Đã Hủy', 'desc' => 'Đơn hàng này đã bị hủy và không được xử lý', 'completed' => true]
            ] : [
                ['status' => 'Đang chờ', 'label' => 'Đơn Hàng Đã Đặt', 'desc' => 'Đơn hàng đang chờ xác nhận', 'completed' => true],
                ['status' => 'Đã xác nhận', 'label' => 'Đã Xác Nhận', 'desc' => 'Đơn hàng đã được xác nhận', 'completed' => in_array($order->TrangThai, ['Đã xác nhận', 'Đang giao hàng', 'Hoàn thành', 'Hoàn tất'])],
                ['status' => 'Đang giao hàng', 'label' => 'Đang Giao Hàng', 'desc' => 'Đơn hàng đang được vận chuyển', 'completed' => in_array($order->TrangThai, ['Đang giao hàng', 'Hoàn thành', 'Hoàn tất'])],
                ['status' => 'Hoàn thành', 'label' => 'Đã Giao Hàng', 'desc' => 'Đơn hàng đã được giao thành công', 'completed' => in_array($order->TrangThai, ['Hoàn thành', 'Hoàn tất'])],
            ];

        // Tạo HTML thô ngay trong controller
        $html = '';
        foreach ($trackingSteps as $step) {
            $icon = match (true) {
                $step['status'] === 'Hủy đơn' => 'bi-x-circle-fill',
                $step['completed'] => 'bi-check-circle-fill',
                $step['status'] === 'Đang giao hàng' => 'bi-truck',
                default => 'bi-house-door',
            };

            $statusClass = $step['completed'] ? 'completed' : ($order->TrangThai === $step['status'] ? 'active' : '');

            $html .= '<div class="timeline-item ' . $statusClass . '">';
            $html .= '  <div class="timeline-icon"><i class="bi ' . $icon . '"></i></div>';
            $html .= '  <div class="timeline-content">';
            $html .= '    <h5>' . e($step['label']) . '</h5>';
            $html .= '    <p>' . e($step['desc']) . '</p>';

            if ($step['completed'] || $order->TrangThai === $step['status']) {
                $html .= '<span class="timeline-date">' . $order->NgayLap->format('M d, Y - h:i A') . '</span>';
            }

            $html .= '  </div>';
            $html .= '</div>';
        }

        return response($html);
    }
}

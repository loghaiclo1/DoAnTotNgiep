<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hoadon;
use App\Events\OrderStatusUpdated;
use App\Notifications\ThongBaoHuyDon;
use Termwind\Components\Hr;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;

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
                            ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($search) . '%'])
                            ->orWhere('SoDienThoai', 'like', "%{$search}%");
                    });
            }
        }

        if ($status = $request->input('status')) {
            $query->where('TrangThai', $status);
        }
        if ($request->filled('payment_status')) {
            if ($request->payment_status == 'paid') {
                $query->where(function ($q) {
                    $q->where('PT_ThanhToan', 2)
                        ->orWhere(function ($q2) {
                            $q2->where('PT_ThanhToan', 1)->where('TrangThai', 'Hoàn tất');
                        });
                });
            } elseif ($request->payment_status == 'unpaid') {
                $query->where(function ($q) {
                    $q->where('PT_ThanhToan', 1)->where('TrangThai', '!=', 'Hoàn tất');
                });
            }
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

        return view('admin.orders', compact('orders'));
    }

    public function show($id)
    {
        $donhang = Hoadon::with(['khachhang', 'chitiethoadon.sach'])->findOrFail($id);
        return view('admin.orders.show', compact('donhang'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('update order status')) {
            abort(403, 'Bạn không có quyền cập nhật trạng thái đơn hàng.');
        }
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
            if ($trangThaiHienTai === 'Hoàn tất' || $trangThaiHienTai === "Đang giao hàng") {
                if ($trangThaiHienTai === 'Hoàn tất') {
                    return redirect()->back()->with('error', 'Không thể hủy đơn hàng đã hoàn tất.');
                } else {
                    return redirect()->back()->with('error', 'Không thể hủy đơn hàng đang giao.');
                }
            }
            $donhang->TrangThai = $trangThaiMoi;
            $donhang->save();
            app(\App\Http\Controllers\Home\InventoryController::class)->restoreStock($donhang->MaHoaDon);
            event(new OrderStatusUpdated($donhang->MaHoaDon, $donhang->TrangThai));

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
        if ($trangThaiMoi === 'Hoàn tất') {
            app(\App\Http\Controllers\Home\InventoryController::class)->finalizeStock($donhang->MaHoaDon);
        }
        \Log::info('Gửi broadcast cho đơn hàng: ' . $donhang->MaHoaDon);
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    }
    public function trackingHtml($id)
    {
        $order = Hoadon::with('chitiethoadon.sach')->findOrFail($id);

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
    public function exportPdf($mahoadon)
    {
        $donhang = Hoadon::with(['khachhang', 'chitiethoadon.sach'])
            ->where('MaHoaDon', $mahoadon)
            ->firstOrFail();

        $pdf = Pdf::loadView('admin.orders.invoice-pdf', compact('donhang'));

        // Tên file tùy ý
        $fileName = 'hoadon_' . $donhang->MaHoaDon . '.pdf';

        // Trả về file PDF để tải luôn
        return $pdf->download($fileName);
    }
    public function viewPdf($mahoadon)
    {
        $donhang = Hoadon::with(['khachhang', 'chitiethoadon.sach'])
            ->where('MaHoaDon', $mahoadon)
            ->firstOrFail();

        $pdf = Pdf::loadView('admin.orders.invoice-pdf', compact('donhang'));

        return $pdf->stream('hoadon_' . $donhang->MaHoaDon . '.pdf', [
            'Attachment' => false
        ]);
    }
    public function showPdfPage($mahoadon)
    {
        return view('admin.orders.pdf-view', compact('mahoadon'));
    }
    public function cancelRequests(Request $request)
    {
        $query = Hoadon::with('khachhang')
            ->where('TrangThai', 'Chờ duyệt hủy')
            ->orderByDesc('NgayLap');

        if ($request->filled('q')) {
            $keyword = $request->q;

            if (preg_match('/#?ORD-\d{4}-(\d+)/', $keyword, $matches)) {
                $keyword = $matches[1]; // chỉ lấy số đơn
            }

            $query->where(function ($q) use ($keyword) {
                $q->where('MaHoaDon', 'like', "%{$keyword}%")
                    ->orWhere('SoDienThoai', 'like', "%{$keyword}%")
                    ->orWhereHas('khachhang', function ($sub) use ($keyword) {
                        $sub->whereRaw("CONCAT(Ho, ' ', Ten) LIKE ?", ["%{$keyword}%"]);
                    });
            });
        }

        $orders = $query->paginate(10);

        return view('admin.orders.cancel-order', compact('orders'));
    }

    public function cancelApprove(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:hoadon,MaHoaDon',
            'action' => 'required|in:approve,reject',
        ]);

        $order = Hoadon::findOrFail($request->order_id);

        if ($order->TrangThai !== 'Chờ duyệt hủy') {
            return back()->with('error', 'Đơn hàng không còn trong trạng thái chờ huỷ.');
        }

        if ($request->action === 'approve') {
            $order->TrangThai = 'Hủy đơn';
            $message = 'Đã chấp thuận huỷ đơn.';
            $notifyMessage = 'Yêu cầu hủy đơn hàng #ORD-2025-' . $order->MaHoaDon . ' của bạn đã được chấp thuận. Đơn hàng đã được hủy.';
        } else {
            $order->TrangThai = $order->PT_ThanhToan == 2 ? 'Đã xác nhận' : 'Đang chờ';
            $order->LyDoHuy = null;
            $message = 'Đã từ chối huỷ đơn.';
            $notifyMessage = 'Yêu cầu hủy đơn hàng #ORD-2025-' . $order->MaHoaDon . ' của bạn đã bị từ chối. Đơn hàng sẽ tiếp tục được xử lý.';
        }

        $order->save();

        if ($order->khachhang && $order->khachhang->email) {
            $order->khachhang->notify(new ThongBaoHuyDon($notifyMessage));
        }
        return back()->with('success', $message);
    }
}

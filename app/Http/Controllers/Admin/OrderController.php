<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Events\OrderStatusUpdated;
use App\Models\Order;
class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        // Tìm kiếm theo mã đơn hoặc tên khách
        if ($search = $request->search) {
            $query->where(function ($q) use ($search) {
                $q->where('ma_don', 'like', "%$search%")
                  ->orWhere('ten_khach', 'like', "%$search%");
            });
        }

        // Lọc theo trạng thái
        if ($status = $request->trang_thai) {
            $query->where('trang_thai', $status);
        }

        // Sắp xếp theo thời gian
        $sort = $request->sort === 'asc' ? 'asc' : 'desc';
        $query->orderBy('created_at', $sort);

        // Lấy danh sách đơn hàng (kèm sản phẩm nếu có liên kết)
        $orders = $query->with('items')->paginate(10);

        return view('admin.orders', compact('orders'));
    }

public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);

    // Cập nhật trạng thái
    $order->trang_thai = $request->input('trang_thai');
    $order->save();

    event(new OrderStatusUpdated($order->id, $order->trang_thai));

    return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
}
}

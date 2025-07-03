<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use App\Models\Book;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{
    // Trừ tồn kho tạm thời khi đơn ở trạng thái "Đang chờ"
    public function reserveStock($maHoaDon)
    {
        $hoadon = HoaDon::with('chitiethoadon')->find($maHoaDon);

        if (!$hoadon || $hoadon->TrangThai !== 'Đang chờ') {
            Log::warning('Không thể trừ kho tạm thời: Hóa đơn không hợp lệ.', ['maHoaDon' => $maHoaDon]);
            return false;
        }

        foreach ($hoadon->chitiethoadon as $item) {
            $book = Book::find($item->MaSach);
            if (!$book) continue;

            if ($book->SoLuong < $item->SoLuong) {
                Log::error("Sách {$book->TenSach} không đủ tồn kho để giữ tạm thời.");
                continue;
            }

            $book->SoLuong -= $item->SoLuong;
            $book->save();
        }

        Log::info('Đã trừ kho tạm thời cho hóa đơn: ' . $maHoaDon);
        return true;
    }

    // Cập nhật lượt mua khi đơn chuyển sang "Hoàn tất"
    public function finalizeStock($maHoaDon)
    {
        $hoadon = HoaDon::with('chitiethoadon')->find($maHoaDon);

        if (!$hoadon || $hoadon->TrangThai !== 'Hoàn tất') {
            Log::warning('Không thể trừ kho thật: Trạng thái không hợp lệ.', ['maHoaDon' => $maHoaDon]);
            return false;
        }

        foreach ($hoadon->chitiethoadon as $item) {
            $book = Book::find($item->MaSach);
            if (!$book) continue;

            $book->LuotMua += $item->SoLuong;
            $book->save();
        }

        Log::info('Đã cập nhật lượt mua cho hóa đơn hoàn tất: ' . $maHoaDon);
        return true;
    }

    // Hoàn kho nếu đơn bị hủy
    public function restoreStock($maHoaDon)
    {
        $hoadon = HoaDon::with('chitiethoadon')->find($maHoaDon);

        if (!$hoadon || $hoadon->TrangThai !== 'Hủy đơn') {
            Log::warning('Không thể hoàn kho: Hóa đơn không hợp lệ.', ['maHoaDon' => $maHoaDon]);
            return false;
        }

        foreach ($hoadon->chitiethoadon as $item) {
            $book = Book::find($item->MaSach);
            if (!$book) continue;

            $book->SoLuong += $item->SoLuong;
            $book->save();
        }

        Log::info('Đã hoàn kho cho hóa đơn bị hủy: ' . $maHoaDon);
        return true;
    }
}

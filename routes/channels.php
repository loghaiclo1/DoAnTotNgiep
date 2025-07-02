<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel('user.{id}', function ($user, $id) {
    Log::info('Authenticating channel user.{id}', [
        'user_id' => $user ? $user->MaKhachHang : 'null',
        'channel_id' => $id,
        'auth_check' => Auth::check()
    ]);

    if (!Auth::check()) {
        Log::warning('User not authenticated for channel user.{id}', ['id' => $id]);
        return false;
    }

    return (int) $user->MaKhachHang === (int) $id;
});

Broadcast::channel('orders.{orderId}', function ($user, $orderId) {
    return true; // Hoặc thêm logic kiểm tra quyền
});
Broadcast::channel('book.reviews.{MaSach}', function ($user, $MaSach) {
    return true; // hoặc kiểm tra quyền nếu cần
});

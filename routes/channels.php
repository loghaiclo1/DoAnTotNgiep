<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('orders.{orderId}', function ($user, $orderId) {
    return true; // Hoặc kiểm tra quyền nếu cần
});
Broadcast::channel('user.{id}', function () {
    return true;
});

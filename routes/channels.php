<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('order.{orderId}', function ($user, $orderId) {
    return true; // Hoặc xác thực quyền nếu cần
});

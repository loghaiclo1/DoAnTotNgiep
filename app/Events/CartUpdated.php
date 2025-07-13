<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow; 
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CartUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $cartTotalQuantity;

    public function __construct($cartTotalQuantity)
    {
        $this->cartTotalQuantity = $cartTotalQuantity;
    }

    public function broadcastOn()
    {
        return new Channel('cart');
    }

    public function broadcastAs()
    {
        return 'cart.updated'; // Tên sự kiện
    }
}

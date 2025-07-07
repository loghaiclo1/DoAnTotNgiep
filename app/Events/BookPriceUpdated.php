<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class BookPriceUpdated implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $bookId;
    public $bookName;
    public $oldPrice;
    public $newPrice;

    public function __construct($bookId, $bookName, $oldPrice, $newPrice)
    {
        $this->bookId = $bookId;
        $this->bookName = $bookName;
        $this->oldPrice = (int) $oldPrice;
        $this->newPrice = (int) $newPrice;

        \Log::info('Khởi tạo sự kiện BookPriceUpdated', [
            'bookId' => $this->bookId,
            'bookName' => $this->bookName,
            'oldPrice' => $this->oldPrice,
            'newPrice' => $this->newPrice,
            'channel' => 'books',
            'event' => 'book.price.updated',
            'user_id' => auth()->check() ? auth()->id() : null
        ]);
    }

    // ✅ PHẢI CÓ method broadcastOn
    public function broadcastOn()
    {
        return new Channel('books');
    }

    public function broadcastAs()
    {
        return 'book.price.updated';
    }
}

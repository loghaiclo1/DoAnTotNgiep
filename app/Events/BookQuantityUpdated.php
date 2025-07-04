<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class BookQuantityUpdated implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $bookId;
    public $newQuantity;

    public function __construct($bookId, $newQuantity)
    {
        $this->bookId = $bookId;
        $this->newQuantity = (int)$newQuantity;
        \Log::info('Khởi tạo sự kiện BookQuantityUpdated', [
            'bookId' => $this->bookId,
            'newQuantity' => $this->newQuantity,
            'channel' => 'books',
            'event' => 'book.quantity.updated',
            'user_id' => auth()->check() ? auth()->id() : null
        ]);
    }

    public function broadcastOn()
    {
        return new Channel('books'); // Sử dụng kênh public
    }

    public function broadcastAs()
    {
        return 'book.quantity.updated';
    }
}


<?php

namespace App\Events;

use App\Models\DanhGiaSanPham;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
class ReviewApproved implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $review;

    public function __construct(DanhGiaSanPham $review)
    {
        $this->review = $review;
    }
    public function broadcastOn()
    {
        return new PrivateChannel('product.' . $this->review->MaSach);
    }
    public function broadcastWith()
    {
        return [
            'id' => $this->review->MaDanhGia,
            'content' => $this->review->NoiDung,
            'stars' => $this->review->SoSao,
            'user_name' => $this->review->user->HoTen,
            'book_id' => $this->review->MaSach,
            'created_at' => $this->review->NgayDanhGia,
        ];
    }

    public function broadcastAs()
    {
        return 'review.approved';
    }
}

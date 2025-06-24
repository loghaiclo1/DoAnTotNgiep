<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    protected $fillable = [
        'ma_don', 'ten_khach', 'email', 'tong_tien', 'trang_thai'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

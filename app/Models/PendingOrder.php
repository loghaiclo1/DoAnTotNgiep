<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingOrder extends Model
{
    protected $table = 'donhangtam';
    // Cho phép gán hàng loạt những cột này
    protected $fillable = [
        'txn_ref',
        'order_data',
        'cart_data',
    ];

    protected $casts = [
        'order_data' => 'array',
        'cart_data'  => 'array',
    ];
}

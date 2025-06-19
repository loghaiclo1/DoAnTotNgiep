<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhuongThucThanhToan extends Model
{
    protected $table = 'phuongthucthanhtoan';
    protected $primaryKey = 'MaPhuongThuc';
    public $timestamps = false;

    protected $fillable = ['MaPhuongThuc', 'TenPhuongThuc'];

    // Quan hệ nếu có...
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    protected $table = 'khuyenmai';
    protected $primaryKey = 'MaKhuyenMai';
    public $timestamps = false;

    protected $fillable = [
        'TenKhuyenMai', 'MoTa', 'MaCode', 'GiaTri', 'Kieu', 'NgayBatDau', 'NgayKetThuc', 'TrangThai',
    ];
}

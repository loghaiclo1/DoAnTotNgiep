<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hoadon extends Model
{
    protected $table = 'hoadon';
    protected $primaryKey = 'MaHoaDon';
    public $timestamps = false;

    protected $fillable = [
        'MaKhachHang', 'NgayLap', 'TongTien', 'TrangThai', 'LyDoHuy','PT_ThanhToan', 'DiaChi', 'SoDienThoai', 'GhiChu',
    ];
    protected $casts = [
        'NgayLap' => 'datetime',
    ];
    public function chitiethoadon()
    {
        return $this->hasMany(Chitiethoadon::class, 'MaHoaDon', 'MaHoaDon');
    }

    public function phuongthucthanhtoan()
    {
        return $this->belongsTo(Phuongthucthanhtoan::class, 'PT_ThanhToan', 'MaPhuongThuc');
    }
    public function khachhang()
    {
        return $this->belongsTo(Khachhang::class, 'MaKhachHang', 'MaKhachHang');
    }
}

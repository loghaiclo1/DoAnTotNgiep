<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhGiaSanPham extends Model
{
    protected $table = 'danhgiasanpham';
    protected $primaryKey = 'MaDanhGia';
    public $timestamps = false; // vì đang dùng NgayDanhGia

    protected $fillable = [
        'MaHoaDon',
        'MaKhachHang',
        'MaSach',
        'NoiDung',
        'SoSao',
        'NgayDanhGia',
        'TrangThai'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'MaSach', 'MaSach');
    }

    public function user()
    {
        return $this->belongsTo(KhachHang::class, 'MaKhachHang', 'MaKhachHang');
    }
}

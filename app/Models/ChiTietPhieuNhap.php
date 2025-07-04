<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietPhieuNhap extends Model
{
    protected $table = 'chi_tiet_phieu_nhap';
    protected $primaryKey = 'MaChiTietNhap';

    protected $fillable = [
        'MaPhieuNhap',
        'MaSach',
        'SoLuong',
        'DonGia',
    ];

    public function phieuNhap()
    {
        return $this->belongsTo(PhieuNhap::class, 'MaPhieuNhap', 'MaPhieuNhap');
    }

    public function sach()
    {
        return $this->belongsTo(Book::class, 'MaSach', 'MaSach');
    }
}

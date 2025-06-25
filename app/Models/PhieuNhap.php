<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KhachHang;
class PhieuNhap extends Model
{
    protected $table = 'phieu_nhap';
    protected $primaryKey = 'MaPhieuNhap';

    protected $fillable = [
        'MaKhachHang',
        'GhiChu',
    ];

    public function chi_tiet()
    {
        return $this->hasMany(ChiTietPhieuNhap::class, 'MaPhieuNhap');
    }
    public function nguoi_nhap()
    {
        return $this->belongsTo(KhachHang::class, 'MaKhachHang', 'MaKhachHang');
    }


}


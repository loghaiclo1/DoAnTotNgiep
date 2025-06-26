<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiaChiNhanHang extends Model
{
    protected $table = 'dia_chi_nhan_hang';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'khachhang_id',
        'ten_nguoi_nhan',
        'so_dien_thoai',
        'dia_chi_cu_the',
        'tinh_thanh_id',
        'quan_huyen_id',
        'phuong_xa_id',
        'mac_dinh',
    ];

    public function tinhThanh()
    {
        return $this->belongsTo(TinhThanh::class, 'tinh_thanh_id', 'id');
    }

    public function quanHuyen()
    {
        return $this->belongsTo(QuanHuyen::class, 'quan_huyen_id', 'id');
    }

    public function phuongXa()
    {
        return $this->belongsTo(PhuongXa::class, 'phuong_xa_id', 'id');
    }
    public function khachhang()
    {
        return $this->belongsTo(KhachHang::class, 'khachhang_id', 'MaKhachHang');
    }
}

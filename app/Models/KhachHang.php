<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class KhachHang extends Authenticatable
{
    protected $table = 'khachhang';
    protected $primaryKey = 'MaKhachHang';
    protected $fillable = ['MaKhachHang', 'HoTen', 'Email', 'SoDienThoai', 'FirebaseUID', 'TrangThai', 'MatKhau'];
    public $timestamps = false;
    public function getAuthPassword()
{
    return $this->MatKhau;
}

}

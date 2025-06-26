<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class KhachHang extends Authenticatable
{
    protected $table = 'khachhang';
    protected $primaryKey = 'MaKhachHang';

    protected $fillable = ['MaKhachHang', 'HoTen', 'Email', 'TrangThai', 'MatKhau', 'role'];
    public $timestamps = false;
    public function getAuthPassword()
    {
        return $this->MatKhau;
    }
    public function addresses()
    {
        return $this->hasMany(DiaChiNhanHang::class, 'khachhang_id', 'MaKhachHang');
    }
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
}

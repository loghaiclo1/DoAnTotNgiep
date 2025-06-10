<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    protected $table = 'khachhang';
    protected $primaryKey = 'MaKhachHang';
    protected $fillable = ['MaKhachHang', 'HoTen', 'Email', 'SoDienThoai', 'FirebaseUID', 'TrangThai', 'MatKhau'];
    public $timestamps = false;
}

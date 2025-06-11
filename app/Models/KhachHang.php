<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    protected $table = 'khachhang';
    protected $primaryKey = 'MaKhachHang';
    protected $fillable = ['MaKhachHang', 'Ho', 'Ten', 'Email', 'TrangThai', 'MatKhau'];
    public $timestamps = true;

    const CREATED_AT = 'NgayTao';
    const UPDATED_AT = 'NgayCapNhat';
}

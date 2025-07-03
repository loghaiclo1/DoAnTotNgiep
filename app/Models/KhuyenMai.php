<?php

// app/Models/KhuyenMai.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class KhuyenMai extends Model
{
    protected $table = 'khuyenmai';
    protected $primaryKey = 'MaKhuyenMai';
    public $timestamps = false; // vì bảng không có created_at, updated_at

    protected $fillable = [
        'TenKhuyenMai',
        'MoTa',
        'MaCode',
        'GiaTri',
        'Kieu',
        'NgayBatDau',
        'NgayKetThuc',
        'TrangThai',
    ];

    public function isValid()
    {
        $now = Carbon::now();
        return $this->TrangThai == 1 &&
            $now->between($this->NgayBatDau, $this->NgayKetThuc);
    }

    public function calculateDiscount($orderTotal)
    {
        if ($this->Kieu == 'phantram') {
            return round($orderTotal * ($this->GiaTri / 100));
        } elseif ($this->Kieu == 'tien') {
            return min($this->GiaTri, $orderTotal);
        }
        return 0;
    }
}

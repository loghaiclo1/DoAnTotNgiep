<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuanHuyen extends Model
{
    protected $table = 'quanhuyen';
    protected $primaryKey = 'id';
    protected $fillable = ['ten', 'tinh_thanh_id'];

    public function tinhThanh()
    {
        return $this->belongsTo(TinhThanh::class, 'tinh_thanh_id', 'id');
    }

    public function phuongXas()
    {
        return $this->hasMany(PhuongXa::class, 'quan_huyen_id', 'id');
    }
}

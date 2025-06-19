<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TinhThanh extends Model
{
    protected $table = 'tinh_thanhs';
    protected $primaryKey = 'id';
    protected $fillable = ['ten'];

    public function quanHuyens()
    {
        return $this->hasMany(QuanHuyen::class, 'tinh_thanh_id', 'id');
    }
}

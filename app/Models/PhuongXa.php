<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhuongXa extends Model
{
    protected $table = 'phuongxa';
    protected $primaryKey = 'id';
    protected $fillable = ['ten', 'quan_huyen_id'];

    public function quanHuyen()
    {
        return $this->belongsTo(QuanHuyen::class, 'quan_huyen_id', 'id');
    }
}

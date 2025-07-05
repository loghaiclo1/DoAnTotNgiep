<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $table = 'footers';
    public $timestamps = false;
    protected $fillable = [
        'loai_du_lieu', 'ten_muc', 'ten_muc_con', 'noi_dung', 'duong_dan',
        'ten_cong_ty', 'dia_chi', 'email', 'dien_thoai', 'mo_ta'
    ];
}

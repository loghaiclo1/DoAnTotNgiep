<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $table = 'footers';

    protected $fillable = [
        'loai_du_lieu', 'ten_muc', 'noi_dung', 'duong_dan', 'ten_cong_ty',
        'dia_chi', 'email', 'dien_thoai', 'mo_ta'
    ];
}

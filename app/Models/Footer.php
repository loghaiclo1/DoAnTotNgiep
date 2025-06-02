<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $table = 'du_lieu_chan_trang'; // Chỉ định đúng tên bảng

    protected $fillable = [
        'loai_du_lieu', 'ten_muc', 'noi_dung', 'duong_dan', 'ten_cong_ty',
        'dia_chi', 'email', 'dien_thoai', 'mo_ta'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chitiethoadon extends Model
{
    protected $table = 'chitiethoadon';
    public $timestamps = false;

    protected $fillable = [
        'MaHoaDon', 'MaSach', 'SoLuong', 'DonGia',
    ];

    public function sach()
    {
        return $this->belongsTo(Book::class, 'MaSach', 'MaSach');
    }
}

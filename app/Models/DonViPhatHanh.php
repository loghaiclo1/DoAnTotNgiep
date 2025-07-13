<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DonViPhatHanh extends Model
{

    use SoftDeletes;
    protected $table = 'donviphathanh';
    protected $primaryKey = 'MaDVPH';
    public $timestamps = true;
    protected $fillable = [
        'TenDVPH',
        'DiaChi',
        'DienThoai',
        'Email',
        'image',
        'slug',
    ];
    public function books()
    {
        return $this->belongsToMany(Book::class, 'sach_donviphathanh', 'MaDVPH', 'MaSach');
    }
    public function nhaxuatban()
    {
        return $this->belongsToMany(NhaXuatBan::class, 'nhaxuatban_donviphathanh', 'MaDVPH', 'MaNXB');
    }
}

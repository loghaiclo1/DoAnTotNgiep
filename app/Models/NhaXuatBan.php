<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class NhaXuatBan extends Model
{
    use SoftDeletes;
    protected $table = 'nhaxuatban'; // Tên bảng đúng trong CSDL của bạn

    protected $primaryKey = 'MaNXB';
    public $timestamps = true; // Bảng của bạn có `created_at`, `updated_at`
    protected $fillable = [
        'TenNXB',
        'image',
        'DiaChi',
        'DienThoai',
        'Email',
        'website',
        'slug',
    ];
    public function books()
    {
        return $this->hasMany(Book::class, 'MaNXB');
    }
    public function donviphathanh()
    {
        return $this->belongsToMany(DonViPhatHanh::class, 'nhaxuatban_donviphathanh', 'MaNXB', 'MaDVPH');
    }
}

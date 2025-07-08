<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    
    protected $table = 'sach'; // Tên bảng đúng trong CSDL của bạn

    protected $primaryKey = 'MaSach'; // Khóa chính không phải "id"

    public $timestamps = true; // Bảng của bạn có `created_at`, `updated_at`

    protected $fillable = [
        'TenSach',
        'category_id',
        'GiaNhap',
        'GiaBan',
        'SoLuong',
        'NamXuatBan',
        'MoTa',
        'TrangThai',
        'LuotMua',
        'HinhAnh',
        'slug',
    ];

    // Quan hệ: Sách thuộc 1 danh mục
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    // Kiểm tra số lượng tồn kho
    public function hasEnoughStock($quantity)
    {
        return $this->SoLuong >= $quantity;
    }

    // Giảm số lượng tồn kho (dùng khi thanh toán)
    public function reduceStock($quantity)
    {
        if ($this->hasEnoughStock($quantity)) {
            $this->SoLuong -= $quantity;
            $this->save();
            return true;
        }
        return false;
    }
    public function reviews()
    {
        return $this->hasMany(DanhGiaSanPham::class, 'MaSach', 'MaSach');
    }
}

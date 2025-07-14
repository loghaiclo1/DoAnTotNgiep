<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Category extends Model
{
    protected $table = 'danhmuc'; // tên bảng

    protected $fillable = [
        'name',
        'parent_id',
        'image',
        'slug',
        'trangthai',
    ];

    // Nếu bạn dùng timestamps (created_at, updated_at)
    public $timestamps = true;

    // Mối quan hệ: danh mục con
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Mối quan hệ: danh mục cha
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Mối quan hệ: sách thuộc danh mục này
    public function books()
    {
        return $this->hasMany(Book::class, 'category_id');
    }
}

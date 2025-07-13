<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use Illuminate\Database\Eloquent\SoftDeletes;
class TacGia extends Model
{
    use SoftDeletes;
    protected $table = 'tacgia';
    protected $primaryKey = 'MaTacGia';

    protected $fillable = [
        'TenTacGia',
        'gioi_tinh',
        'nam_sinh',
        'que_quan_id',
        'ghi_chu',
        'created_at',
        'updated_at',
    ];

    public function sach()
    {
        return $this->hasMany(Book::class, 'MaTacGia');
    }
    public function xa()
    {
        return $this->belongsTo(PhuongXa::class, 'que_quan_id');
    }
    public function huyen()
    {
        return optional($this->xa)->quanHuyen;
    }

    public function tinh()
    {
        return optional($this->xa)->quanHuyen ? $this->xa->quanHuyen->tinhThanh : null;
    }
}

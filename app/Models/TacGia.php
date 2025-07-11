<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
class TacGia extends Model
{
    protected $table = 'tacgia';
    protected $primaryKey = 'MaTacGia';

    protected $fillable = [
        'TenTacGia',
        'created_at',
        'updated_at',
    ];

    public function sach()
    {
        return $this->hasMany(Book::class, 'MaTacGia');
    }
}

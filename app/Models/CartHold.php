<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartHold extends Model
{
    protected $table = 'giugiohang';
    protected $fillable = ['user_id', 'session_id', 'book_id', 'quantity'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'MaSach');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartHold extends Model
{
    protected $fillable = ['user_id', 'session_id', 'book_id', 'quantity', 'expires_at'];
    public function book()
{
    return $this->belongsTo(Book::class, 'book_id', 'MaSach');
}
}

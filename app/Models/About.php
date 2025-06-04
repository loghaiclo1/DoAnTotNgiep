<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'baiviet';
    protected $primaryKey = 'slug';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['tieude', 'slug', 'noidung', 'anhbaiviet', 'trangthai', 'chude', 'created_at', 'updated_at'];

}

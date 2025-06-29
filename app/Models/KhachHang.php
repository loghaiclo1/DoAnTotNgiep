<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use App\Notifications\ResetPasswordNotification;

class KhachHang extends Authenticatable implements CanResetPassword
{
    use Notifiable, CanResetPasswordTrait;
    protected $table = 'khachhang';
    protected $primaryKey = 'MaKhachHang';

    protected $fillable = ['MaKhachHang', 'Ho', 'Ten', 'email', 'TrangThai', 'MatKhau', 'role'];
    protected $hidden = ['MatKhau', 'remember_token'];
    public $timestamps = false;
    public function getAuthPassword()
    {
        return $this->MatKhau;
    }
    public function addresses()
    {
        return $this->hasMany(DiaChiNhanHang::class, 'khachhang_id', 'MaKhachHang');
    }
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}

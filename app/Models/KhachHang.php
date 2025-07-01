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

    protected $fillable = ['MaKhachHang', 'Ho', 'Ten', 'email', 'TrangThai', 'MatKhau', 'role', 'avatar', 'remember_token'];
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
        return in_array($this->role, ['admin', 'superadmin']);
    }

    public function isSuperAdmin()
    {
        return $this->role === 'superadmin';
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}

<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use App\Notifications\ResetPasswordNotification;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;

class KhachHang extends Authenticatable implements CanResetPassword
{
    use Notifiable, CanResetPasswordTrait, HasRoles, HasPermissions {
        HasPermissions::hasPermissionTo as protected spatieHasPermissionTo;
    }

    protected $table = 'khachhang';
    protected $primaryKey = 'MaKhachHang';

    protected $fillable = [
        'MaKhachHang', 'Ho', 'Ten', 'email', 'TrangThai',
        'MatKhau', 'role', 'avatar', 'remember_token', 'last_login_at'
    ];

    protected $hidden = ['MatKhau', 'remember_token'];

    public $timestamps = false;

    /**
     * Override mật khẩu để dùng cột `MatKhau` thay vì `password`
     */
    public function getAuthPassword()
    {
        return $this->MatKhau;
    }

    /**
     * Danh sách địa chỉ giao hàng
     */
    public function addresses()
    {
        return $this->hasMany(DiaChiNhanHang::class, 'khachhang_id', 'MaKhachHang');
    }

    /**
     * Kiểm tra có phải admin hoặc superadmin không
     */
    public function isAdmin()
    {
        return in_array($this->role, ['admin', 'superadmin']);
    }

    /**
     * Kiểm tra có phải superadmin không
     */
    public function isSuperAdmin()
    {
        return $this->role === 'superadmin';
    }

    /**
     * Gửi email đặt lại mật khẩu
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Override kiểm tra quyền: Super Admin luôn có quyền
     */
    public function hasPermissionTo($permission, $guardName = null): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return $this->spatieHasPermissionTo($permission, $guardName);
    }
}

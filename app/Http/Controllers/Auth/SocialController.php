<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use App\Models\KhachHang as User; // Sử dụng model KhachHang như User
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $fullName = $googleUser->getName(); // hoặc $googleUser->name
        $names = preg_split('/\s+/', trim($fullName), 2);

        if (count($names) == 1) {
            $lastName = '';
            $firstName = $names[0];
        } else {
            $lastName = $names[0];
            $firstName = $names[1];
        }

        $existingUser = User::where('email', $googleUser->getEmail())->first();

        if ($existingUser) {
            // Người dùng đã tồn tại, cập nhật thông tin cần thiết (không cập nhật role)
            $existingUser->update([
                'Ho' => $lastName,
                'Ten' => $firstName,
                'email_verified_at' => now(),
                'TrangThai' => 1,
            ]);
            $user = $existingUser;
        } else {
            // Người dùng mới, tạo mới với role mặc định
            $user = User::create([
                'Ho' => $lastName,
                'Ten' => $firstName,
                'email' => $googleUser->getEmail(),
                'email_verified_at' => now(),
                'TrangThai' => 1,
                'avatar' => 'avatar.png',
                'role' => 'user',
                'password' => bcrypt(uniqid()),
            ]);
        }

        Auth::login($user);

        if (in_array($user->role, ['admin', 'superadmin'])) {
            return redirect()->route('admin.dashboard'); // hoặc route admin chính
        }
        return redirect()->route('home')->with('success', 'Đăng nhập bằng Google thành công.');
    }
}

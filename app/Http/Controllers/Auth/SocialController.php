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

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'Ho' => $lastName,
                'Ten' => $firstName,
                'email' => $googleUser->getEmail(),
                'email_verified_at' => now(),
                'TrangThai' => 1,
                'password' => bcrypt(uniqid()) // Tạo password ngẫu nhiên nếu cần
            ]
        );

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Đăng nhập bằng Google thành công.');
    }
}

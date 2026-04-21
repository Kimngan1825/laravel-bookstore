<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account']) 
            ->redirect();
    }

    public function callback()
{
    try {
        $googleUser = Socialite::driver('google')
            ->setHttpClient(new \GuzzleHttp\Client(['verify' => false])) 
            ->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->email],
            [
                'full_name' => $googleUser->name, 
                'password' => bcrypt('12345678@'),
                // 'role_id' => 2, // Nếu là user mới thì mặc định là 2
            ]
        );

        Auth::login($user, true);
        request()->session()->regenerate();

        // --- SỬA ĐOẠN NÀY ĐỂ PHÂN QUYỀN GIỐNG AUTHCONTROLLER ---
        if ($user->role_id == 1) {
            return redirect('/admin/dashboard');
        }

        return redirect()->to('/sach');

    } catch (\Exception $e) {
        return redirect('/login')->with('error', 'Lỗi: ' . $e->getMessage());
    }
    }
}
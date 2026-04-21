<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // form login
    public function loginForm(){
        return view('auth.login');
    }

    public function login(Request $req){
        $credentials = $req->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Chuyển hướng dựa trên role_id
            if ($user->role_id == 1) {
                return redirect('/admin/dashboard')->with('msg', 'Chào mừng Admin quay trở lại');
            } 
            
            return redirect('/sach')->with('msg', 'Đăng nhập thành công');
        }

        return back()->with('error', 'Email hoặc mật khẩu không chính xác');
    }

    // form register
    public function registerForm(){
        return view('auth.register');
    }

    // xử lý register
    public function register(Request $req){
    $req->validate([
        'full_name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed'
    ]);

    User::create([
        'full_name' => $req->full_name,
        'email' => $req->email,
        'password' => Hash::make($req->password),
        'role_id' => 2 // Luôn mặc định là User thường
    ]);

    return redirect('/login')->with('msg', 'Đăng ký thành công, mời bạn đăng nhập');
    }

    // logout
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
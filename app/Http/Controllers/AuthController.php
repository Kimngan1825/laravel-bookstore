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

    // xử lý login
    public function login(Request $req){
        if(Auth::attempt($req->only('email','password'))){
            return redirect('/home');
        }
        return back()->with('error','Sai thông tin');
    }

    // form register
    public function registerForm(){
        return view('auth.register');
    }

    // xử lý register
    public function register(Request $req){
    $req->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed'
    ],[
        'email.unique' => 'Email đã tồn tại',
        'password.confirmed' => 'Mật khẩu nhập lại không khớp'
    ]);

    User::create([
        'name'=>$req->name,
        'email'=>$req->email,
        'password'=>Hash::make($req->password)
    ]);

    return redirect('/login')->with('msg','Đăng ký thành công');
}

    // logout
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
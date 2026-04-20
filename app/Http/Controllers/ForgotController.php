<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotController extends Controller
{
    public function form(){
        return view('auth.forgot-password');
    }

    public function send(Request $req){
        Password::sendResetLink($req->only('email'));
        return back()->with('msg','Đã gửi email!');
    }
}
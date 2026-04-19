<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(){
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email'=>$googleUser->email],
            ['name'=>$googleUser->name, 'password'=>bcrypt('123')]
        );

        Auth::login($user);

        return redirect('/home');
    }
}

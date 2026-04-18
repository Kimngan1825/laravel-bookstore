<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ForgotController;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route hiển thị mặc định (Trang chủ sách)
Route::get('/sach', [\App\Http\Controllers\HomeController::class, 'sach']);

//require __DIR__.'/auth.php';



// auth
Route::get('/login',[AuthController::class,'loginForm'])->name('login');
Route::post('/login',[AuthController::class,'login']);

Route::get('/logout',[AuthController::class,'logout']);

// google
Route::get('/auth/google',[GoogleAuthController::class,'redirect']);
Route::get('/auth/google/callback',[GoogleAuthController::class,'callback']);

// forgot password
Route::get('/forgot',[ForgotController::class,'form']);
Route::post('/forgot',[ForgotController::class,'send']);

Route::get('/register',[AuthController::class,'registerForm'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/forgot',[ForgotController::class,'send'])->name('password.email');

Route::get('/reset-password/{token}', function ($token, Request $request) {
    return view('auth.reset-password', [
        'request' => $request
    ]);
})->name('password.reset');
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
        'token' => 'required',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        }
    );

    return redirect('/login')->with('msg','Đổi mật khẩu thành công');
});
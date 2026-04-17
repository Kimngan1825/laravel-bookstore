<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController; // Đưa lên đầu cho gọn

// Trang chủ: Chuyển hướng thẳng đến danh sách sách
Route::get('/', function () {
    return redirect()->route('products');
});

// Route hiển thị danh sách sách (Công khai)
Route::get('/sach', [HomeController::class, 'sach'])->name('products');

// Nhóm các chức năng yêu cầu đăng nhập (Chức năng 5 của Quang)
Route::middleware(['auth'])->group(function () {
    
    // 1. Hồ sơ cá nhân (Dùng AJAX)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile_update');

    // 2. Yêu thích (Dùng AJAX)
    Route::post('/favorite/toggle', [FavoriteController::class, 'toggle'])->name('favorite_toggle');

    // 3. Thanh toán & Đặt hàng (Dùng AJAX)
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout_process');

    // 4. Lịch sử đơn hàng
    Route::get('/orderhistory', [OrderController::class, 'index'])->name('orderhistory');
});


Route::get('/', function () {
    return view('welcome');
});

// Route hiển thị mặc định (Trang chủ sách)
Route::get('/sach', [\App\Http\Controllers\HomeController::class, 'sach'])->name('products');

require __DIR__.'/auth.php';




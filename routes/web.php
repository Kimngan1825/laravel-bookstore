<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;

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

// Routes cho quản lý sách và giỏ hàng (Controller4)
Route::prefix('book')->group(function () {
    // Xem chi tiết sách
    Route::get('/{id}', [\App\Http\Controllers\Controller4::class, 'show'])->name('book.detail');
    
    // Thêm vào giỏ hàng
    Route::post('/{id}/add-to-cart', [\App\Http\Controllers\Controller4::class, 'addToCart'])->name('book.addToCart');
});

// Routes giỏ hàng
Route::prefix('cart')->group(function () {
    // Hiển thị giỏ hàng (và xử lý POST khi cập nhật toàn bộ)
    Route::match(['get', 'post'], '/', [\App\Http\Controllers\Controller4::class, 'index'])->name('cart.index');

    // Trang checkout
    Route::get('/checkout', [\App\Http\Controllers\Controller4::class, 'checkoutPage'])->name('cart.checkout.page');

    // Checkout
    Route::post('/checkout', [\App\Http\Controllers\Controller4::class, 'checkout'])->name('cart.checkout');
    
    // Cập nhật số lượng sản phẩm
    Route::post('/{id}', [\App\Http\Controllers\Controller4::class, 'updateCart'])->whereNumber('id')->name('cart.update');
    
    // Xóa sản phẩm từ giỏ hàng
    Route::delete('/{id}', [\App\Http\Controllers\Controller4::class, 'remove'])->whereNumber('id')->name('cart.remove');
    
    // Áp dụng mã giảm giá
    Route::post('/coupon/apply', [\App\Http\Controllers\Controller4::class, 'applyCoupon'])->name('coupon.apply');
    
    // Xóa mã giảm giá
    Route::delete('/coupon/remove', [\App\Http\Controllers\Controller4::class, 'removeCoupon'])->name('coupon.remove');
    
});

require __DIR__.'/auth.php';

// google
Route::get('/auth/google',[GoogleAuthController::class,'redirect']);
Route::get('/auth/google/callback',[GoogleAuthController::class,'callback']);

// Backward-compatible URL for old login page links
Route::redirect('/forgot', '/forgot-password');
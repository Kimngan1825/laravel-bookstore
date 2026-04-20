<?php

use Illuminate\Support\Facades\Route;

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

// Route hiển thị tất cả sách (Có phân trang và lọc)
Route::get('/Booklist', [App\Http\Controllers\HomeController::class, 'bookList'])->name('products.index');

// Route này trả về dữ liệu HTML cho ô tìm kiếm gợi ý
Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');

require __DIR__.'/auth.php';




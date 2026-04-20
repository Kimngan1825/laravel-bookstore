
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller2;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- TRANG CHỦ & AUTH ---
Route::get('/', function () {
    return view('welcome');
});

Route::get('/sach', [HomeController::class, 'sach']);

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

// Route hiển thị tất cả sách (Có phân trang và lọc)
Route::get('/Booklist', [App\Http\Controllers\HomeController::class, 'bookList'])->name('products.index');

// Route này trả về dữ liệu HTML cho ô tìm kiếm gợi ý
Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');

require __DIR__.'/auth.php';

// --- KHU VỰC QUẢN TRỊ (ADMIN) ---
Route::prefix('admin')->group(function () {

    // 1. DASHBOARD CHÍNH
    Route::get('/dashboard', [Controller2::class, 'manageadmin'])->name('admin.dashboard');

    // 2. QUẢN LÝ KHO SÁCH (BOOKS)
    Route::get('/books', [Controller2::class, 'managebooks'])->name('admin.books');
    Route::post('/books/save', [Controller2::class, 'savebook'])->name('admin.books.save');
    Route::get('/books/delete/{id}', [Controller2::class, 'deletebook'])->name('admin.books.delete');

    // 3. QUẢN LÝ DANH MỤC (CATEGORIES)
    Route::get('/categories', [Controller2::class, 'managecategories'])->name('admin.categories');
    Route::post('/categories/save', [Controller2::class, 'savecategory'])->name('admin.categories.save');
    Route::get('/categories/delete/{id}', [Controller2::class, 'deletecategory'])->name('admin.categories.delete');

    // 4. QUẢN LÝ ĐƠN HÀNG (ORDERS)
    Route::get('/orders', [Controller2::class, 'manageorders'])->name('admin.orders');
    Route::post('/orders/update', [Controller2::class, 'updateOrderStatus'])->name('admin.orders.update');

    // 5. QUẢN LÝ NGƯỜI DÙNG (USERS)
    Route::get('/users', [Controller2::class, 'manageusers'])->name('admin.users');
    Route::post('/users/update-role', [Controller2::class, 'updateUserRole'])->name('admin.users.updateRole');
    Route::get('/users/toggle/{id}/{status}', [Controller2::class, 'toggleUserStatus'])->name('admin.users.toggle');
    Route::get('/users/delete/{id}', [Controller2::class, 'deleteUser'])->name('admin.users.delete');
    
    // Xem lịch sử đơn hàng của User cụ thể
    Route::get('/userorders/{id}', [Controller2::class, 'userorders'])->name('admin.userorders');
    Route::get('/users/orders/{id}', [Controller2::class, 'userorders'])->name('admin.users.orders');

    // 6. QUẢN LÝ ĐÁNH GIÁ (REVIEWS)
    Route::get('/reviews', [Controller2::class, 'managereviews'])->name('admin.reviews');
    Route::get('/reviews/toggle/{id}/{status}', [Controller2::class, 'toggleReviewStatus'])->name('admin.reviews.toggle');
    Route::get('/reviews/delete/{id}', [Controller2::class, 'deleteReview'])->name('admin.reviews.delete');

    // 7. QUẢN LÝ MÃ GIẢM GIÁ (COUPONS)
    Route::get('/coupons', [Controller2::class, 'managecoupons'])->name('admin.coupons');
    Route::post('/coupons/save', [Controller2::class, 'savecoupon'])->name('admin.coupons.save');
    Route::get('/coupons/delete/{id}', [Controller2::class, 'deletecoupon'])->name('admin.coupons.delete');

});
// google
Route::get('/auth/google',[GoogleAuthController::class,'redirect']);
Route::get('/auth/google/callback',[GoogleAuthController::class,'callback']);

// Backward-compatible URL for old login page links
Route::redirect('/forgot', '/forgot-password');
<?php 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class OrderController extends Controller {
    public function index() {
        $orders = DB::table('orders')
            ->where('user_id', auth()->id())
            ->orderBy('order_date', 'desc')
            ->get();
        return view('orderhistory', compact('orders'));
    }

    public function show($id)
{
    // Lấy thông tin đơn hàng và kết nối với bảng users
    $order = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.user_id') // Kết nối bảng users
        ->where('orders.order_id', $id)
        ->select('orders.*', 'users.full_name', 'users.email', 'users.phone as user_phone') // Lấy thêm cột từ bảng users
        ->first();

    if (!$order) {
        abort(404);
    }

    // Phần lấy items giữ nguyên
    $items = DB::table('order_items')
        ->join('books', 'order_items.book_id', '=', 'books.book_id')
        ->where('order_items.order_id', $id)
        ->select('order_items.*', 'books.title', 'books.image')
        ->get();

    return view('orders.show', compact('order', 'items'));
}
}
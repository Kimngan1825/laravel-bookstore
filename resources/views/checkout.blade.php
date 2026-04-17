<?php
// 1. Khai báo không có chữ "use"
namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

// 2. Bắt buộc phải có thẻ class bọc bên ngoài
class CheckoutController extends Controller {
    
    // Bạn có thể giữ lại hàm index() ở đây nếu cần hiển thị giao diện checkout
    // public function index() { ... }

    public function process(Request $request) {
        $cart = session()->get('cart', []);
        
        DB::beginTransaction();
        try {
            $orderid = DB::table('orders')->insertGetId([
                'user_id' => auth()->id(),
                'total_amount' => $request->total_amount,
                'shipping_address' => $request->address,
                'status' => 'pending',
                'order_date' => now(),
                'payment_method' => 'COD'
            ]);

            foreach($cart as $id => $item) {
                DB::table('order_items')->insert([
                    'order_id' => $orderid,
                    'book_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            $order = DB::table('orders')->where('order_id', $orderid)->first();
            Notification::send(auth()->user(), new \App\Notifications\OrderConfirmNotification($order, $cart));

            DB::commit();
            session()->forget('cart');

            // TRẢ VỀ JSON CHO AJAX
            return response()->json([
                'status' => 'success',
                'message' => 'Đặt hàng thành công! Đang chuyển hướng đến lịch sử đơn hàng...',
                'redirect_url' => route('orderhistory')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
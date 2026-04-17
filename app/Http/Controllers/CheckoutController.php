<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\OrderConfirmNotification;
use Illuminate\Support\Facades\Notification;

class CheckoutController extends Controller {
    
    public function index() {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('products')->with('error', 'Giỏ hàng trống');
        return view('checkout', compact('cart'));
    }

    public function process(Request $request) {
        $cart = session()->get('cart', []);
        
        // Bắt đầu Transaction để đảm bảo an toàn dữ liệu
        DB::beginTransaction();
        try {
            $orderid = DB::table('orders')->insertGetId([
                'user_id' => auth()->id(),
                'total_amount' => $request->total_amount,
                'shipping_address' => $request->address,
                'status' => 'pending',
                'order_date' => now(),
                'payment_method' => $request->payment_method ?? 'COD'
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
            
            // Gửi mail xác nhận
            Notification::send(auth()->user(), new OrderConfirmNotification($order, $cart));

            DB::commit();
            session()->forget('cart');
            
            return redirect()->route('orderhistory')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
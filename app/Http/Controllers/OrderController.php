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
}
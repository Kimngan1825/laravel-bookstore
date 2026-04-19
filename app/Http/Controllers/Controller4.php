<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccess;

class Controller4 extends Controller
{
    // 1. Hiển thị chi tiết thông tin cuốn sách
    public function show($id)
    {
        $book = DB::table('books')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.author_id')
            ->leftJoin('categories', 'books.category_id', '=', 'categories.category_id')
            ->select(
                'books.*',
                'authors.author_name',
                'categories.category_name'
            )
            ->where('books.book_id', $id)
            ->where('books.is_active', 1)
            ->first();

        if (!$book) {
            return redirect()->back()->with('error', 'Sách không tồn tại.');
        }

        // Lấy các bài đánh giá từ người dùng
        $reviews = DB::table('reviews')
            ->join('users', 'reviews.user_id', '=', 'users.user_id')
            ->select('reviews.*', 'users.full_name')
            ->where('reviews.book_id', $id)
            ->where('reviews.is_approved', 1)
            ->orderBy('reviews.created_at', 'desc')
            ->get();

        // Lấy các sách cùng tác giả
        $relatedBooks = DB::table('books')
            ->where('author_id', $book->author_id)
            ->where('book_id', '<>', $id)
            ->where('is_active', 1)
            ->limit(4)
            ->get();

        return view('book.detail', compact('book', 'reviews', 'relatedBooks'));
    }

    // 2. Thêm sách vào giỏ hàng
    public function addToCart($id, Request $request)
    {
        $quantity = $request->input('quantity', 1);
        $quantity = max(1, (int)$quantity); // Đảm bảo số lượng >= 1

        $book = DB::table('books')
            ->where('book_id', $id)
            ->where('is_active', 1)
            ->first();

        if (!$book) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Sách không tồn tại'], 404);
            }
            return redirect()->back()->with('error', 'Sách không tồn tại.');
        }

        if ($book->stock < $quantity) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Số lượng trong kho không đủ'], 400);
            }
            return redirect()->back()->with('error', 'Số lượng trong kho không đủ.');
        }

        $cart = Session::get('cart', []);

        // Nếu sách đã có trong giỏ, cộng số lượng
        if (isset($cart[$id])) {
            $newQuantity = $cart[$id]['so_luong'] + $quantity;
            if ($book->stock < $newQuantity) {
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Số lượng trong kho không đủ'], 400);
                }
                return redirect()->back()->with('error', 'Số lượng trong kho không đủ.');
            }
            $cart[$id]['so_luong'] = $newQuantity;
        } else {
            // Thêm sách mới vào giỏ
            $cart[$id] = [
                'book_id' => $book->book_id,
                'ten_sach' => $book->title,
                'gia_ban' => $book->price,
                'so_luong' => $quantity,
                'hinh_anh' => $book->image
            ];
        }

        Session::put('cart', $cart);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Đã thêm sách vào giỏ hàng',
                'cart_count' => array_sum(array_column($cart, 'so_luong'))
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm sách vào giỏ hàng.');
    }

    // 3. Cập nhật số lượng sách trong giỏ hàng (tăng/giảm)
    public function updateCart($id, Request $request)
    {
        $id = (int)$id; // Đảm bảo ID là integer
        $quantity = (int)$request->input('quantity', 1);
        $quantity = max(1, $quantity); // Đảm bảo số lượng >= 1

        $cart = Session::get('cart', []);
        
        \Log::info('updateCart - ID: ' . $id . ', Quantity: ' . $quantity . ', Cart keys: ' . json_encode(array_keys($cart)));

        if (!isset($cart[$id])) {
            \Log::warning('Product ' . $id . ' not found in cart');
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Sản phẩm không tồn tại trong giỏ hàng'], 404);
            }
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
        }

        $book = DB::table('books')->where('book_id', $id)->first();
        
        if (!$book) {
            \Log::warning('Book ' . $id . ' not found in database');
            return redirect()->back()->with('error', 'Sách không tồn tại trong hệ thống.');
        }

        if ($book->stock < $quantity) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Số lượng trong kho không đủ'], 400);
            }
            return redirect()->back()->with('error', 'Số lượng trong kho không đủ.');
        }

        $cart[$id]['so_luong'] = $quantity;
        Session::put('cart', $cart);
        
        \Log::info('Cart updated successfully for product ' . $id . ' with quantity ' . $quantity);

        // Tính lại tổng tiền
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['gia_ban'] * $item['so_luong'];
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật số lượng thành công',
                'total' => $subtotal
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Cập nhật số lượng thành công.');
    }

    // 4. Hiển thị trang giỏ hàng
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $cart = Session::get('cart', []);

            if ($request->has('remove_item')) {
                $removeId = (int)$request->input('remove_item');
                if (isset($cart[$removeId])) {
                    unset($cart[$removeId]);
                    Session::put('cart', $cart);
                    return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
                }

                return redirect()->route('cart.index')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
            }

            if ($request->has('clear_cart')) {
                Session::forget('cart');
                return redirect()->route('cart.index')->with('success', 'Đã xóa toàn bộ giỏ hàng.');
            }

            if ($request->has('update_item') || $request->has('update_all')) {
                $quantities = $request->input('quantity', []);

                if ($request->has('update_item')) {
                    $updateId = (int)$request->input('update_item');

                    if (!isset($cart[$updateId])) {
                        return redirect()->route('cart.index')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
                    }

                    if (!isset($quantities[$updateId])) {
                        return redirect()->route('cart.index')->with('error', 'Không nhận được số lượng cần cập nhật.');
                    }

                    $qty = max(1, (int)$quantities[$updateId]);
                    $book = DB::table('books')->where('book_id', $updateId)->first();

                    if (!$book) {
                        return redirect()->route('cart.index')->with('error', 'Sách không tồn tại trong hệ thống.');
                    }

                    if ($book->stock < $qty) {
                        return redirect()->route('cart.index')->with('error', 'Số lượng trong kho không đủ.');
                    }

                    $cart[$updateId]['so_luong'] = $qty;
                    Session::put('cart', $cart);
                    return redirect()->route('cart.index')->with('success', 'Cập nhật số lượng thành công.');
                }

                foreach ($quantities as $bookId => $qty) {
                    $bookId = (int)$bookId;
                    $qty = max(1, (int)$qty);

                    if (!isset($cart[$bookId])) {
                        continue;
                    }

                    $book = DB::table('books')->where('book_id', $bookId)->first();
                    if ($book && $book->stock >= $qty) {
                        $cart[$bookId]['so_luong'] = $qty;
                    }
                }

                Session::put('cart', $cart);
                return redirect()->route('cart.index')->with('success', 'Cập nhật giỏ hàng thành công.');
            }
        }

        $cart = Session::get('cart', []);
        $total = 0;

        // Tính tổng tiền
        foreach ($cart as $item) {
            $total += $item['gia_ban'] * $item['so_luong'];
        }

        return view('book.cart', compact('cart', 'total'));
    }

    // 5. Áp dụng mã giảm giá (Voucher)
    public function applyCoupon(Request $request)
    {
        $code = strtoupper($request->input('coupon_code', ''));
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Giỏ hàng trống'], 400);
            }
            return redirect()->back()->with('error', 'Giỏ hàng trống');
        }

        if (empty($code)) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Vui lòng nhập mã giảm giá'], 400);
            }
            return redirect()->back()->with('error', 'Vui lòng nhập mã giảm giá');
        }

        // Tính tổng tiền hiện tại
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['gia_ban'] * $item['so_luong'];
        }

        [$coupon, $couponError] = $this->validateCoupon($code, $subtotal);
        if ($couponError) {
            if ($request->expectsJson()) {
                return response()->json(['error' => $couponError], 400);
            }
            return redirect()->back()->withInput()->with('error', $couponError);
        }

        // Lưu coupon vào session
        Session::put('coupon', $coupon);

        $discount = $this->calculateDiscount($subtotal, $coupon);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Áp dụng mã giảm giá thành công',
                'coupon' => $coupon,
                'discount' => $discount,
                'total' => $subtotal - $discount
            ]);
        }

        return redirect()->back()->with('success', 'Áp dụng mã giảm giá thành công');
    }

    // 6. Xóa mã giảm giá
    public function removeCoupon(Request $request)
    {
        Session::forget('coupon');

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Đã xóa mã giảm giá']);
        }

        return redirect()->back()->with('success', 'Đã xóa mã giảm giá');
    }

    // 2. Xóa sản phẩm khỏi giỏ hàng
    public function remove($id)
    {
        $cart = Session::get('cart', []);
       
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart); // Cập nhật lại session
        }

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    // 3. Xử lý đặt hàng
    public function checkoutPage()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['gia_ban'] * $item['so_luong'];
        }

        $couponInput = strtoupper(trim((string)old('coupon_code', '')));
        $sessionCoupon = Session::get('coupon');
        if ($couponInput === '' && $sessionCoupon && isset($sessionCoupon->code)) {
            $couponInput = strtoupper((string)$sessionCoupon->code);
        }

        $appliedCoupon = null;
        $discountPreview = 0;
        if ($couponInput !== '') {
            [$validatedCoupon, $couponError] = $this->validateCoupon($couponInput, $subtotal);
            if ($validatedCoupon) {
                $appliedCoupon = $validatedCoupon;
                $discountPreview = $this->calculateDiscount($subtotal, $validatedCoupon);
                Session::put('coupon', $validatedCoupon);
            } elseif ($sessionCoupon && isset($sessionCoupon->code) && strtoupper((string)$sessionCoupon->code) === $couponInput) {
                Session::forget('coupon');
            }
        }

        $totalPreview = max(0, $subtotal - $discountPreview);

        $user = Auth::user();
        $cities = DB::table('cities')->orderBy('city_name')->pluck('city_name');

        $savedAddresses = [];
        if (Auth::check()) {
            $savedAddresses = DB::table('shipping_addresses')
                ->where('user_id', Auth::id())
                ->orderByDesc('address_id')
                ->get();
        }

        return view('book.checkout', compact(
            'cart',
            'subtotal',
            'user',
            'cities',
            'savedAddresses',
            'couponInput',
            'appliedCoupon',
            'discountPreview',
            'totalPreview'
        ));
    }

    // 4. Xử lý đặt hàng từ trang checkout
    public function checkout(Request $request)
    {
        $cart = Session::get('cart', []);
       
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        $request->validate([
            'full_name' => 'required|string|min:2|max:255',
            'phone' => 'required|string|min:8|max:20',
            'address_line' => 'required|string|min:5|max:500',
            'city' => 'required|string|max:255',
            'payment_method' => 'required|in:COD,BANK_TRANSFER,E_WALLET',
            'coupon_code' => 'nullable|string|max:50',
        ]);

        $userId = Auth::id() ?? 1;
        $payment_method = $request->input('payment_method', 'COD');
        $fullName = trim((string)$request->input('full_name', ''));
        $phone = trim((string)$request->input('phone', ''));
        $addressLine = trim((string)$request->input('address_line', ''));
        $city = trim((string)$request->input('city', ''));
        $shipping_address = $fullName . ' - ' . $phone . ' - ' . $addressLine . ', ' . $city;
        $couponCodeInput = strtoupper(trim((string)$request->input('coupon_code', '')));

        $sessionCoupon = Session::get('coupon');
        if ($couponCodeInput === '' && $sessionCoupon && isset($sessionCoupon->code)) {
            $couponCodeInput = strtoupper((string)$sessionCoupon->code);
        }

        // Tính tổng tiền đơn hàng trước khi lưu
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['gia_ban'] * $item['so_luong'];
        }

        $coupon = null;
        $discountAmount = 0;
        $couponId = null;
        $couponCode = null;

        DB::beginTransaction();
        try {
            if ($couponCodeInput !== '') {
                [$coupon, $couponError] = $this->validateCoupon($couponCodeInput, $subtotal, true);
                if ($couponError) {
                    DB::rollBack();
                    return redirect()->back()->withInput()->with('error', $couponError);
                }

                $discountAmount = $this->calculateDiscount($subtotal, $coupon);
                $couponId = $coupon->coupon_id ?? null;
                $couponCode = $coupon->code ?? null;
            }

            $totalAmount = max(0, $subtotal - $discountAmount);

            if ($request->boolean('save_new_address') && Auth::check()) {
                DB::table('shipping_addresses')->insert([
                    'user_id' => $userId,
                    'full_name' => $fullName,
                    'phone' => $phone,
                    'address_line' => $addressLine,
                    'city' => $city,
                ]);
            }

            // Lưu đơn hàng
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $userId,
                'coupon_id' => $couponId,
                'order_date' => now(),
                'total_amount' => $totalAmount,
                'discount_amount' => $discountAmount,
                'coupon_code' => $couponCode,
                'status' => 'pending',
                'shipping_address' => $shipping_address,
                'payment_method' => $payment_method
            ]);

            // Lưu chi tiết đơn hàng
            foreach ($cart as $id_sach => $item) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'book_id' => $id_sach,
                    'quantity' => $item['so_luong'],
                    'price' => $item['gia_ban']
                ]);

                // Trừ tồn kho theo số lượng đã đặt, chống âm kho khi nhiều người mua đồng thời
                $updatedRows = DB::table('books')
                    ->where('book_id', $id_sach)
                    ->where('stock', '>=', $item['so_luong'])
                    ->decrement('stock', $item['so_luong']);

                if ($updatedRows === 0) {
                    throw new \RuntimeException('Sách "' . $item['ten_sach'] . '" đã hết hàng hoặc không đủ số lượng.');
                }
            }

            if ($couponId) {
                DB::table('coupons')
                    ->where('coupon_id', $couponId)
                    ->increment('usage_count');
            }

            // --- XỬ LÝ GỬI MAIL ---
            if (Auth::check()) {
                // Lấy email người đang đăng nhập
                $userEmail = Auth::user()->email;
                Mail::to($userEmail)->send(new OrderSuccess($orderId, $cart));
            }

            DB::commit(); // Chỉ xác nhận thành công khi mail đã gửi được
            Session::forget('cart');
            Session::forget('coupon');

            return redirect()->route('cart.index')->with('success', 'Đặt hàng thành công! Đã gửi hóa đơn qua Email.');

        } catch (\Exception $e) {
            DB::rollBack();
            // Nếu gửi mail thất bại do file .env, nó sẽ báo lỗi chi tiết ra màn hình
            return redirect()->route('cart.index')->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    // Helper: Tính tiền giảm giá từ voucher
    private function calculateDiscount($subtotal, $coupon)
    {
        if ($coupon->discount_type === 'percent') {
            return ($subtotal * $coupon->discount_value) / 100;
        } else {
            return min($coupon->discount_value, $subtotal);
        }
    }

    // Helper: Lấy tổng tiền giỏ hàng
    private function getCartTotal()
    {
        $cart = Session::get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['gia_ban'] * $item['so_luong'];
        }

        $coupon = Session::get('coupon', null);
        if ($coupon) {
            $discount = $this->calculateDiscount($subtotal, $coupon);
            return $subtotal - $discount;
        }

        return $subtotal;
    }

    // Helper: Tính lại tổng tiền
    private function calculateCartTotal()
    {
        // Logic để tính lại tổng tiền (nếu cần)
        return $this->getCartTotal();
    }

    private function validateCoupon($code, $subtotal, $lockForUpdate = false)
    {
        $query = DB::table('coupons')
            ->where('code', $code)
            ->where('is_active', 1);

        if ($lockForUpdate) {
            $query->lockForUpdate();
        }

        $coupon = $query->first();

        if (!$coupon) {
            return [null, 'Mã giảm giá không hợp lệ.'];
        }

        if (!empty($coupon->end_date) && strtotime((string)$coupon->end_date) < time()) {
            return [null, 'Mã giảm giá đã hết hạn.'];
        }

        if (!empty($coupon->max_usage) && (int)$coupon->usage_count >= (int)$coupon->max_usage) {
            return [null, 'Mã giảm giá đã hết lượt sử dụng.'];
        }

        if ((float)$subtotal < (float)$coupon->min_order_value) {
            return [null, 'Đơn hàng phải có giá trị tối thiểu ' . number_format($coupon->min_order_value) . ' đ để dùng mã này.'];
        }

        return [$coupon, null];
    }
}


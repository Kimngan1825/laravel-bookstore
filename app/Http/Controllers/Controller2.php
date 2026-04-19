<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Controller2 extends Controller
{
    /* ============================================================
        // 1. DASHBOARD & THỐNG KÊ DOANH THU
    ============================================================ */
    
    public function manageadmin(Request $request)
    {
        $timeFilter = $request->query('time', 'week');
        $searchDate = $request->query('search_date', Carbon::now()->toDateString());
        $date = Carbon::parse($searchDate);

        $chartLabels = [];
        $chartData = [];
        $query = DB::table('orders')->where('status', 'delivered');

        // Xử lý logic lọc thời gian cho biểu đồ
        switch ($timeFilter) {
            case 'date':
                $revenueLabel = "Doanh thu ngày " . $date->format('d/m/Y');
                for ($i = 0; $i < 24; $i++) {
                    $chartLabels[] = $i . "h";
                    $chartData[] = (clone $query)->whereDate('order_date', $date)->whereRaw('HOUR(order_date) = ?', [$i])->sum('total_amount');
                }
                break;
            case 'month':
                $revenueLabel = "Doanh thu tháng " . $date->format('m/Y');
                for ($i = 1; $i <= $date->daysInMonth; $i++) {
                    $chartLabels[] = "N" . $i;
                    $chartData[] = (clone $query)->whereMonth('order_date', $date->month)->whereYear('order_date', $date->year)->whereDay('order_date', $i)->sum('total_amount');
                }
                break;
            case 'year':
                $revenueLabel = "Doanh thu năm " . $date->year;
                for ($i = 1; $i <= 12; $i++) {
                    $chartLabels[] = "Tháng " . $i;
                    $chartData[] = (clone $query)->whereYear('order_date', $date->year)->whereMonth('order_date', $i)->sum('total_amount');
                }
                break;
            default: // week
                $startOfWeek = $date->startOfWeek();
                $revenueLabel = "Doanh thu tuần " . $date->weekOfYear . " - " . $date->year;
                for ($i = 0; $i < 7; $i++) {
                    $currentDay = $startOfWeek->copy()->addDays($i);
                    $chartLabels[] = $currentDay->format('d/m');
                    $chartData[] = (clone $query)->whereDate('order_date', $currentDay)->sum('total_amount');
                }
                break;
        }

        // Lấy Top 5 khách hàng & Sách bán chạy
        $topUsers = DB::table('users')
            ->join('orders', 'users.user_id', '=', 'orders.user_id')
            ->select('users.user_id', 'users.full_name', 'users.email', DB::raw('COUNT(orders.order_id) as total_orders'), DB::raw('SUM(orders.total_amount) as total_spent'))
            ->where('orders.status', 'delivered')
            ->groupBy('users.user_id', 'users.full_name', 'users.email')
            ->orderByDesc('total_spent')->limit(5)->get();

        $bestSellingBooks = DB::table('order_items')
            ->join('books', 'order_items.book_id', '=', 'books.book_id')
            ->select('books.title', DB::raw('SUM(order_items.quantity) as total_qty'))
            ->groupBy('books.book_id', 'books.title')
            ->orderByDesc('total_qty')->limit(5)->get();

        return view('admin.dashboard', [
            'timeFilter'     => $timeFilter,
            'revenueLabel'   => $revenueLabel,
            'chartLabels'    => $chartLabels,
            'chartData'      => $chartData,
            'totalBooks'     => DB::table('books')->count(),
            'totalUsers'     => DB::table('users')->where('role_id', 2)->count(),
            'totalOrders'    => DB::table('orders')->count(),
            'topUsers'       => $topUsers,
            'bookLabels'     => $bestSellingBooks->pluck('title'),
            'bookData'       => $bestSellingBooks->pluck('total_qty'),
            'dynamicRevenue' => array_sum($chartData)
        ]);
    }

    /* ============================================================
        // 2. QUẢN LÝ KHO SÁCH
    ============================================================ */

    public function managebooks(Request $request)
    {
        $authors = DB::table('authors')->get();
        $categories = DB::table('categories')->get();
        
        // Thiết lập thông báo khi sách trong kho sắp hết (Dưới 5 cuốn)
        $lowStockBooks = DB::table('books')->where('stock', '<', 5)->where('is_active', 1)->get();

        $books = DB::table('books')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.author_id')
            ->leftJoin('categories', 'books.category_id', '=', 'categories.category_id')
            ->select('books.*', 'authors.author_name', 'categories.category_name')
            ->orderByDesc('books.book_id')->get();

        $bookToEdit = $request->edit_id ? DB::table('books')->where('book_id', $request->edit_id)->first() : null;

        return view('admin.managebooks', compact('authors', 'categories', 'books', 'bookToEdit', 'lowStockBooks'));
    }

    public function savebook(Request $request)
    {
        // Nhận đầy đủ các trường từ Form chi tiết
        $data = $request->only([
            'title', 'author_id', 'category_id', 'price', 'stock', 
            'supplier', 'publisher', 'publication_year', 'language', 
            'page_count', 'weight', 'size', 'description'
        ]);
        
        $data['is_active'] = $request->is_active ?? 1;

        // Thực hiện chức năng: Upload ảnh bìa sách
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(storage_path('app/public/uploads/books'), $imageName);
            $data['image'] = $imageName;
        }

        DB::table('books')->updateOrInsert(['book_id' => $request->book_id], $data);
        return redirect()->route('admin.books')->with('success', 'Lưu dữ liệu thành công!');
    }

    public function deletebook($id)
    {
        DB::table('books')->where('book_id', $id)->delete();
        return back();
    }

    /* ============================================================
        // 3. QUẢN LÝ DANH MỤC
    ============================================================ */

    public function managecategories(Request $request)
    {
        $categories = DB::table('categories')->get();
        $catToEdit = $request->edit_id ? DB::table('categories')->where('category_id', $request->edit_id)->first() : null;
        return view('admin.managecategories', compact('categories', 'catToEdit'));
    }

    public function savecategory(Request $request)
    {
        DB::table('categories')->updateOrInsert(
            ['category_id' => $request->category_id],
            ['category_name' => $request->category_name]
        );
        return redirect()->route('admin.categories');
    }

    public function deletecategory($id)
    {
        DB::table('categories')->where('category_id', $id)->delete();
        return redirect()->route('admin.categories');
    }

    /* ============================================================
        // 4. QUẢN LÝ MÃ GIẢM GIÁ (COUPONS)
    ============================================================ */

    public function managecoupons()
    {
        $coupons = DB::table('coupons')->orderByDesc('coupon_id')->get();
        return view('admin.managecoupons', compact('coupons'));
    }

    public function savecoupon(Request $request)
    {
        DB::table('coupons')->insert([
            'code'            => strtoupper(trim($request->code)),
            'discount_type'   => $request->discount_type,
            'discount_value'  => $request->discount_value,
            'min_order_value' => $request->min_order_value ?? 0,
            'max_usage'       => $request->max_usage ?? 100,
            'end_date'        => $request->end_date,
            'is_active'       => 1
        ]);
        return redirect()->route('admin.coupons')->with('success', 'Đã lưu mã giảm giá mới!');
    }

    public function deletecoupon($id)
    {
        DB::table('coupons')->where('coupon_id', $id)->delete();
        return redirect()->route('admin.coupons');
    }

    /* ============================================================
        // 5. QUẢN LÝ ĐÁNH GIÁ (REVIEWS)
    ============================================================ */

    public function managereviews()
    {
        $reviews = DB::table('reviews')
            ->join('users', 'reviews.user_id', '=', 'users.user_id')
            ->join('books', 'reviews.book_id', '=', 'books.book_id')
            ->select('reviews.*', 'users.full_name', 'books.title', 'books.image')
            ->orderBy('reviews.is_approved', 'asc')
            ->orderByDesc('reviews.created_at')->get();

        return view('admin.managereviews', compact('reviews'));
    }

    public function toggleReviewStatus($id, $status)
    {
        DB::table('reviews')->where('review_id', $id)->update(['is_approved' => ($status == 1 ? 0 : 1)]);
        return redirect()->route('admin.reviews')->with('success', 'Cập nhật trạng thái thành công!');
    }

    public function deleteReview($id)
    {
        DB::table('reviews')->where('review_id', $id)->delete();
        return redirect()->route('admin.reviews');
    }

    /* ============================================================
        // 6. QUẢN LÝ ĐƠN HÀNG
    ============================================================ */

    public function manageorders(Request $request)
    {
        $statusFilter = $request->query('status', 'all');
        
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.user_id')
            ->select('orders.*', 'users.full_name')
            ->when($statusFilter !== 'all', fn($q) => $q->where('orders.status', $statusFilter))
            ->orderByDesc('orders.order_date')->get();

        $orderDetail = null;
        $orderItems = [];
        if ($request->id) {
            $orderDetail = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.user_id')
                ->where('orders.order_id', $request->id)
                ->select('orders.*', 'users.full_name', 'users.email', 'users.phone')->first();

            if ($orderDetail) {
                $orderItems = DB::table('order_items')
                    ->join('books', 'order_items.book_id', '=', 'books.book_id')
                    ->where('order_items.order_id', $request->id)
                    ->select('order_items.*', 'books.title', 'books.image')->get();
            }
        }

        return view('admin.manageorders', compact('orders', 'orderDetail', 'orderItems', 'statusFilter'));
    }

    public function updateOrderStatus(Request $request)
    {
        $status = $request->new_status == 'processing' ? 'confirmed' : $request->new_status;

        try {
            DB::table('orders')->where('order_id', $request->order_id)->update(['status' => $status]);
            return redirect()->route('admin.orders', ['id' => $request->order_id, 'status' => $request->current_filter])
                             ->with('success', 'Cập nhật trạng thái thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi hệ thống: ' . $e->getMessage());
        }
    }

    /* ============================================================
        // 7. QUẢN LÝ NGƯỜI DÙNG (USERS)
    ============================================================ */

    public function manageusers()
    {
        $users = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->select('users.*', 'roles.role_name')
            ->orderByDesc('users.user_id')->get();
        return view('admin.manageusers', compact('users'));
    }

    public function updateUserRole(Request $request)
    {
        if ($request->user_id == auth()->id()) {
            return back()->with('error', 'Bạn không thể tự thay đổi quyền của chính mình!');
        }
        DB::table('users')->where('user_id', $request->user_id)->update(['role_id' => $request->role_id]);
        return redirect()->route('admin.users')->with('success', 'Cập nhật quyền thành công!');
    }

    public function toggleUserStatus($id, $status)
    {
        DB::table('users')->where('user_id', $id)->update(['status' => ($status == 1 ? 0 : 1)]);
        return redirect()->route('admin.users');
    }

    public function deleteUser($id)
    {
        if ($id != auth()->id()) {
            DB::table('users')->where('user_id', $id)->delete();
        }
        return redirect()->route('admin.users');
    }

    /* ============================================================
        // 8. LỊCH SỬ ĐƠN HÀNG KHÁCH HÀNG (USER ORDERS)
    ============================================================ */

    public function userorders($id)
    {
        $userInfo = DB::table('users')->where('user_id', $id)->first();
        
        if (!$userInfo) {
            return redirect()->back()->with('error', 'không tìm thấy khách nhen!');
        }

        $orderList = DB::table('orders')
            ->where('user_id', $id)
            ->orderByDesc('order_date')
            ->get();

        return view('admin.userorders', compact('userInfo', 'orderList'));
    }
}
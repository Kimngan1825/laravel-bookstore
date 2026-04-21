<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function sach()
    {
        $categories = DB::table('categories')
            ->select('categories.category_id', 'categories.category_name', 
                DB::raw('(SELECT image FROM books WHERE books.category_id = categories.category_id AND is_active = 1 LIMIT 1) as book_image'))
            ->get();

        $saleBooks = DB::table('books')->where('is_active', 1)->where('discount', '>', 0)->take(5)->get();
        $newBooks = DB::table('books')->where('is_active', 1)->orderBy('created_at', 'desc')->take(5)->get();
        $bestSellers = DB::table('books')->where('is_active', 1)->take(5)->get();
        
        $top5Books = DB::table('books')
            ->leftJoin('order_items', 'books.book_id', '=', 'order_items.book_id')
            ->where('books.is_active', 1)
            ->select(
                'books.book_id', 
                'books.title', 
                'books.price', 
                'books.image', 
                'books.discount',
                DB::raw('IFNULL(SUM(order_items.quantity), 0) as total_sold') 
            )
            ->groupBy('books.book_id', 'books.title', 'books.price', 'books.image', 'books.discount')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        return view('components.index', compact('categories', 'saleBooks', 'newBooks', 'bestSellers', 'top5Books'));
    }

    public function index() {
        $heroSlides = [
            ['image' => 'banners/hero/h1.jpg', 'link' => route('products.index', ['sale' => 'christmas'])],
            ['image' => 'banners/hero/h2.jpg', 'link' => route('products.index', ['sale' => 'newyear'])]
        ];

        $categories = Category::with(['books' => function($q) {
            $q->where('is_active', 1)->select('book_id', 'category_id', 'image')->limit(1);
        }])->get();

        $saleBooks = Book::where('is_active', 1)->where('discount', '>', 0)->orderBy('discount', 'desc')->take(5)->get();
        $bestSellers = Book::where('is_active', 1)->withCount(['orderItems as total_sold'])->orderBy('total_sold', 'desc')->take(8)->get(); 
        $newBooks = Book::where('is_active', 1)->orderBy('created_at', 'desc')->take(5)->get();
        $top5Books = $bestSellers->take(5); 

        return view('components.index', compact('heroSlides', 'categories', 'saleBooks', 'top5Books', 'newBooks', 'bestSellers'));
    }

    public function search(Request $request)
    {

        $q = $request->query('q');
        $categories = DB::table('categories')->get(); 
        $books = DB::table('books')->where('is_active', 1)->where('title', 'LIKE', "%{$q}%")->get();
        return view('components.search', compact('books', 'q', 'categories'));
    }

    public function bookList(Request $request)
    {
        $categories = DB::table('categories')->get();
        $type = $request->query('type', 'all');
        $title = 'Tất cả sách';

        // Khởi tạo query và lọc is_active luôn
        $query = DB::table('books')->where('is_active', 1);

        if ($type === 'flash') {
            $query->where('discount', '>', 0)->orderBy('discount', 'desc');
            $title = 'Giảm giá sốc';
        } elseif ($type === 'top') {
            $orderCounts = DB::table('order_items')->select('book_id', DB::raw('SUM(quantity) as total_sold'))->groupBy('book_id');
            $query->leftJoinSub($orderCounts, 'order_counts', function ($join) {
                    $join->on('books.book_id', '=', 'order_counts.book_id');
                })
                ->select('books.*', DB::raw('IFNULL(order_counts.total_sold, 0) as total_sold'))
                ->orderByDesc('total_sold');
            $title = 'Bảng xếp hạng tuần';
        } elseif ($type === 'new') {
            $query->orderBy('created_at', 'desc');
            $title = 'Sách mới phát hành';
        } elseif ($type === 'today') {
            $query->inRandomOrder();
            $title = 'Gợi ý hôm nay';
        }

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        $books = $query->paginate(12)->withQueryString();

        return view('components.booklist', compact('categories', 'books', 'title'));
    }
}
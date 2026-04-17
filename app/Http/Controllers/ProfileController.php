<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller {
    public function index() {
        $user = DB::table('users')->where('user_id', auth()->id())->first();
        
        // Đã sửa thành bảng favorites
        $favorites = DB::table('favorites')
            ->join('books', 'favorites.book_id', '=', 'books.book_id')
            ->where('favorites.user_id', auth()->id())
            ->get();
            
        return view('profile', compact('user', 'favorites'));
    }

    public function update(Request $request) {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id() . ',user_id',
            'phone' => 'nullable|string|max:20',
        ]);

        DB::table('users')
            ->where('user_id', auth()->id())
            ->update([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

        return back()->with('success', 'Hồ sơ đã được cập nhật!');
    }
}
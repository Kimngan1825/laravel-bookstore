<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->user_id;

        $user = DB::table('users')
            ->where('user_id', $userId)
            ->first();

        $favorites = DB::table('favorites')
            ->join('books', 'favorites.book_id', '=', 'books.book_id')
            ->where('favorites.user_id', $userId)
            ->select(
                'favorites.book_id',
                'books.title',
                'books.price',
                'books.image'
            )
            ->get();

        $addresses = DB::table('shipping_addresses')
            ->where('user_id', $userId)
            ->get();

        return view('profile', compact('user', 'favorites', 'addresses'));
    }

    public function update(Request $request)
    {
        $userId = Auth::user()->user_id;

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId . ',user_id',
            'phone' => 'nullable|string|max:20',
        ]);

        DB::table('users')
            ->where('user_id', $userId)
            ->update([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'created_at' => now()
            ]);

        return back()->with('success', 'Hồ sơ đã được cập nhật!');
    }

    public function changePassword(Request $request)
    {
        $userId = Auth::user()->user_id;

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        $user = DB::table('users')
            ->where('user_id', $userId)
            ->first();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Mật khẩu hiện tại không đúng');
        }

        DB::table('users')
            ->where('user_id', $userId)
            ->update([
                'password' => bcrypt($request->new_password)
            ]);

        return back()->with('success', 'Đổi mật khẩu thành công');
    }
}
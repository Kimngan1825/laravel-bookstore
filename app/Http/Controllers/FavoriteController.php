<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller {
    public function toggle(Request $request) {
        $request->validate([
            'book_id' => 'required|integer|exists:books,book_id'
        ]);

        $bookid = $request->book_id;
        $userid = auth()->id();

        $fav = DB::table('favorites')
            ->where('user_id', $userid)
            ->where('book_id', $bookid)
            ->first();

        if ($fav) {
            DB::table('favorites')->where('favorite_id', $fav->favorite_id)->delete();
            return response()->json(['status' => 'removed', 'message' => 'Đã xóa khỏi yêu thích']);
        } else {
            DB::table('favorites')->insert([
                'user_id' => $userid,
                'book_id' => $bookid,
                'created_at' => now()
            ]);
            return response()->json(['status' => 'added', 'message' => 'Đã thêm vào yêu thích']);
        }
    }
}
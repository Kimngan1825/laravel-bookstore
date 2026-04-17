<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function sach()
    {
        $books = DB::table('books')->get();
        return view('components.index', compact('books')); 
    }
}
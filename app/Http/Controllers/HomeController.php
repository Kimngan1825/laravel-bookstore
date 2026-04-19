<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function sach()
    {
        $books = Book::all();
        return view('components.index', compact('books')); 
    }
}
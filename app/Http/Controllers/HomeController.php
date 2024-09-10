<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan daftar pengarang dan buku.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $authors = Author::paginate(10);
        $books = Book::paginate(10);

        return view('index', compact('authors', 'books'));
    }
}

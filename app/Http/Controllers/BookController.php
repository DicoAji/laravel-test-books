<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Menampilkan daftar buku dengan pagination.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $books = Book::paginate(10); // Menampilkan 10 buku per halaman
        return view('index', compact('books'));
    }

    /**
     * Menyimpan buku baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:books,serial_number',
            'published_at' => 'required|integer|digits:4',
            'author_id' => 'required|exists:authors,id',
        ]);

        Book::create([
            'title' => $request->title,
            'serial_number' => $request->serial_number,
            'published_at' => $request->published_at,
            'author_id' => $request->author_id,
        ]);

        return redirect()->route('home')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir untuk mengedit buku.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\View\View
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('editbook', compact('book', 'authors'));
    }

    /**
     * Memperbarui data buku.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:books,serial_number,' . $book->id,
            'published_at' => 'required|integer|digits:4',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book->update([
            'title' => $request->title,
            'serial_number' => $request->serial_number,
            'published_at' => $request->published_at,
            'author_id' => $request->author_id,
        ]);

        return redirect()->route('home')->with('success', 'Data buku berhasil diperbarui.');
    }

    /**
     * Menghapus buku.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('home')->with('success', 'Data buku berhasil dihapus.');
    }
}

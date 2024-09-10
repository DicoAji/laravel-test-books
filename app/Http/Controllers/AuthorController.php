<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Menampilkan daftar author dengan pagination.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $authors = Author::paginate(10);
        // dd($authors);
        return view('index', compact('authors'));
    }
    // Method untuk menyimpan pengarang baru
    /**
     * Method untuk menyimpan pengarang baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email',
        ]);

        Author::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('home')->with('success', 'Pengarang berhasil ditambahkan.');
    }
    /**
     * Menampilkan form edit untuk pengarang.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('edit', compact('author')); // Buat view 'edit' untuk menampilkan form edit
    }

    /**
     * Update pengarang yang ada.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email,' . $id, // Unik kecuali untuk email pengarang saat ini
        ]);

        $author = Author::findOrFail($id);
        $author->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('home')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Menghapus pengarang.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('home')->with('success', 'Pengarang berhasil dihapus.');
    }
}

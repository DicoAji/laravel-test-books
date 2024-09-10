<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/addauthors', [AuthorController::class, 'store'])->name('authors.store');
Route::get('/authors/{id}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
Route::put('/authors/{id}', [AuthorController::class, 'update'])->name('authors.update');
Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');

// Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/addbooks', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

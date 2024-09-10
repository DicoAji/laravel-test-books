<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'books';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = ['title', 'serial_number', 'published_at', 'author_id'];

    // Relasi Many-to-One dengan Model Author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}

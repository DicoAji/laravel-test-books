<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    // Nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'authors';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = ['name', 'email'];

    // Relasi One-to-Many dengan Model Book
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}

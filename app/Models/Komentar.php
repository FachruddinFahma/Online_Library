<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar';

    protected $fillable = ['user_id', 'book_id', 'isi_komentar', 'parent_id'];

    // Relasi user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Parent komentar
    public function parent()
    {
        return $this->belongsTo(Komentar::class, 'parent_id');
    }

    // Children langsung
    public function children()
    {
        return $this->hasMany(Komentar::class, 'parent_id');
    }

    // Children recursive (semua level)
    public function childrenRecursive()
    {
        return $this->children()->with('user', 'childrenRecursive');
    }
}

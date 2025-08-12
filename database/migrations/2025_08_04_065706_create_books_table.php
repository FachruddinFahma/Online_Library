<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('name');                   // Judul buku
            $table->year('year');                    // Tahun terbit
            $table->string('author');                // Penulis
            $table->string('publisher');             // Penerbit
            $table->integer('pageCount');            // Jumlah halaman
            $table->string('genre');                 // Genre buku (WAJIB)
            $table->string('cover')->nullable();     // Gambar cover (optional)
            $table->text('summary')->nullable();     // Ringkasan buku (optional)
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

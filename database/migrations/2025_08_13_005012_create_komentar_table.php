<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');   // foreign key ke users
            $table->unsignedBigInteger('book_id');   // foreign key ke books
            $table->unsignedBigInteger('parent_id')->nullable(); // untuk reply

            $table->text('isi_komentar');            // isi komentarnya
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('komentar')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};

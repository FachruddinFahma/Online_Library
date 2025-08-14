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

            $table->string('name');      
            $table->year('year');         
            $table->string('author');
            $table->string('publisher');             
            $table->integer('pageCount');            
            $table->string('genre');                 
            $table->string('cover')->nullable();    
            $table->text('summary')->nullable();    
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

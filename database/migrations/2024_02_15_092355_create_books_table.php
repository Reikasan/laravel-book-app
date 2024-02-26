<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('sub_title', 255)->nullable();
            $table->string('authors', 100);
            $table->text('description')->nullable();
            $table->string('image_thumbnail', 255)->nullable();
            $table->string('image_large', 255)->nullable();
            $table->string('isbn', 100)->nullable()->unique();
            $table->string('isbn13', 100)->nullable()->unique();
            $table->string('language', 100)->nullable();
            $table->integer('page_count')->nullable();
            $table->string('publisher', 100)->nullable();
            $table->string('published_date', 100)->nullable();
            $table->string('categories')->nullable();
            $table->string(('google_book_id'))->unique();
            $table->string('google_book_link', 255);
            $table->boolean('isBookInDatabase')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

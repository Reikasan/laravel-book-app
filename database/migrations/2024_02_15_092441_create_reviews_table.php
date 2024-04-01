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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');
            $table->foreignId('book_id')->constrained()
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');
            $table->integer('rating')->nullable();
            $table->date('review_date')->nullable();
            $table->text('review')->nullable();
            $table->boolean('is_draft')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

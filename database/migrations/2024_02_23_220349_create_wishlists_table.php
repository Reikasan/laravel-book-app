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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->foreignId('book_id')->constrained()
                                          ->onDelete('cascade')
                                          ->onUpdate('cascade');
            $table->foreignId('user_id')->constrained()
                                            ->onDelete('cascade')
                                            ->onUpdate('cascade');
            $table->primary(['book_id', 'user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist');
    }
};

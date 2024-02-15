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
        Schema::create('category_users', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()
                                            ->onDelete('cascade')
                                            ->onUpdate('cascade');
            $table->foreignId('user_id')->constrained()
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');
            $table->primary(['category_id', 'user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_users');
    }
};

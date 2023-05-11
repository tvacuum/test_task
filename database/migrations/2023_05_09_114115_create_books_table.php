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
            $table->text('title');
            $table->text('slug');
            $table->unsignedBigInteger('author_id')->index('author_id');
            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->cascadeOnDelete();
            $table->longText('description');
            $table->float('rating')->default(0);
            $table->longText('cover');
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

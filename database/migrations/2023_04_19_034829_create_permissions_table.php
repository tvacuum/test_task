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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->index('role_id');
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('module_id')->index('module_id');
            $table->foreign('module_id')
                ->references('id')
                ->on('modules')
                ->cascadeOnDelete();
            $table->boolean('c')->default(0);
            $table->boolean('r')->default(0);
            $table->boolean('u')->default(0);
            $table->boolean('d')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};

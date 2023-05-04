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
        Schema::create('time_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->date('date');
            $table->time('time_start');
            $table->time('time_end')->nullable();
            $table->float('total_timebreak')->nullable();
            $table->float('total')->nullable();
            $table->boolean('without_lunch')->nullable();
            $table->boolean('forgot_flag')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('workplace_id')->index('workplace_id');
            $table->foreign('workplace_id')
                ->references('id')
                ->on('workplaces')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_report');
    }
};

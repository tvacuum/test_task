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
        Schema::create('timebreaks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('day_id')->index('day_id');
            $table->foreign('day_id')
                ->references('id')
                ->on('time_reports')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('leave_workplace_id')->index('leave_workplace_id')->nullable();
            $table->foreign('leave_workplace_id')
                ->references('id')
                ->on('workplaces')
                ->cascadeOnUpdate();
            $table->unsignedBigInteger('comeback_workplace_id')->index('comeback_workplace_id')->nullable();
            $table->foreign('comeback_workplace_id')
                ->references('id')
                ->on('workplaces')
                ->cascadeOnUpdate();
            $table->time('time_leave');
            $table->time('time_comeback')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timebreak');
    }
};

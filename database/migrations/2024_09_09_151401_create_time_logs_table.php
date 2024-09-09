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
        Schema::create('time_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('external_id')->unique();
            $table->integer('task_external_id');
            $table->foreign('task_external_id')->references('external_id')->on('tasks')->onDelete('cascade');
            $table->integer('employee_external_id');
            $table->foreign('employee_external_id')->references('external_id')->on('employees')->onDelete('cascade');
            $table->float('hours_spent');
            $table->timestamps();
            $table->string('process_uuid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_logs');
    }
};

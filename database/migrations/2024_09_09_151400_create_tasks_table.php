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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('external_id')->unique();
            $table->integer('project_external_id');
            $table->foreign('project_external_id')->references('external_id')->on('projects')->onDelete('cascade');
            $table->integer('milestone_external_id')->nullable();
            $table->foreign('milestone_external_id')->references('external_id')->on('milestones')->onDelete('cascade');
            $table->integer('employee_external_id')->nullable();
            $table->foreign('employee_external_id')->references('external_id')->on('employees')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->nullable();
            $table->string('priority')->nullable();
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamps();
            $table->string('process_uuid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('external_id')->unique();
            $table->string('name');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('status');
            $table->integer('project_manager_external_id')->nullable();
            $table->timestamps();
            $table->string('process_uuid')->nullable();
            $table->foreign('project_manager_external_id')
                  ->references('external_id')
                  ->on('employees')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

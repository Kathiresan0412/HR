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
        Schema::create('employee_work_shifts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('employee')->unsigned()->index()->nullable();
            $table->foreign('employee')->references('id')->on('employees')->onDelete('set null');
            $table->date('date');
            $table->boolean('is_of_day');
            $table->boolean('is_of_hour');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_work_shifts');
    }
};

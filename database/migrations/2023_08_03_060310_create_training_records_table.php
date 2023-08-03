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
        Schema::create('training_records', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('training_program')->unsigned()->index()->nullable();
            $table->foreign('training_program')->references('id')->on('training_programs')->onDelete('set null');
            $table->bigInteger('employee')->unsigned()->index()->nullable();
            $table->foreign('employee')->references('id')->on('employees')->onDelete('set null');
            $table->decimal('score'); 
            $table->string('certificate'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_records');
    }
};

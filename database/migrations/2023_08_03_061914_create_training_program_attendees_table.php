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
        Schema::create('training_program_attendees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('program')->unsigned()->index()->nullable();
            $table->foreign('program')->references('id')->on('training_programs')->onDelete('set null');
            $table->bigInteger('attendees')->unsigned()->index()->nullable();
            $table->foreign('attendees')->references('id')->on('employees')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_program_attendees');
    }
};

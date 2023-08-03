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
        Schema::create('employee_healths', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee')->unsigned()->nullable();
            $table->foreign('employee')->references('id')->on('employees')->onDelete('set null');
            $table->date('medical_examination_date');
            $table->string('medical_condition');
            $table->string('Doctor_notes');
            $table->string('allergies');
            $table->string('prescription_details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_healths');
    }
};

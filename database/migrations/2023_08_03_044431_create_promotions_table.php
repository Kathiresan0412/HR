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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee')->unsigned()->index()->nullable();
            $table->foreign('employee')->references('id')->on('employees')->onDelete('set null');
            $table->string('previous_position');
            $table->string('previous_salary');
            $table->date('from');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.a
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};

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
        Schema::create('employee_feedback', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee')->unsigned()->nullable();
            $table->foreign('employee')->references('id')->on('employees')->onDelete('set null');
            $table->date('feedback_date');
            $table->string('feedback_comments');
            $table->string('survey questions and responses');//link
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_feedback');
    }
};

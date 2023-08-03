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
        Schema::create('employee_documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee')->unsigned()->nullable();
            $table->foreign('employee')->references('id')->on('employees')->onDelete('set null');
            $table->string('ol_level_al_level_resheets'); //all file uplogg
            $table->string('aa');
            $table->string('feedback_date');
            $table->string('feedback_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_documents'); //jjj
    }
};

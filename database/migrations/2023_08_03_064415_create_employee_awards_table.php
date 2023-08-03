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
        Schema::create('employee_awards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee')->unsigned()->index()->nullable();
            $table->foreign('employee')->references('id')->on('employees')->onDelete('set null');
            $table->date('received_date');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_awards');
    }
};

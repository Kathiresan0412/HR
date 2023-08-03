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
        Schema::create('o_t_s', function (Blueprint $table) {
            $table->id();
  
            $table->bigInteger('employee')->unsigned()->nullable();
            $table->foreign('employee')->references('id')->on('employees')->onDelete('set null');
            $table->datetime('ot_hour');
            $table->decimal('hour_payment');
            $table->decimal('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('o_t_s');
    }
};

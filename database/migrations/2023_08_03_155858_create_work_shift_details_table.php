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
        Schema::create('work_shift_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('work_shif_id')->unsigned()->index()->nullable();
            $table->foreign('work_shif_id')->references('id')->on('employee_work_shifts')->onDelete('set null');
            $table->datetime('from');
            $table->datetime('to');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_shift_details');
    }
};

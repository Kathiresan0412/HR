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
        Schema::create('attendence_adjusments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->string('remark');
            $table->string('added_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendence_adjusments');
    }
};

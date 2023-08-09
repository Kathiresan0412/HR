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
        Schema::create('leave_request_dates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('leave_request_id')->unsigned()->index()->nullable();
            $table->foreign('leave_request_id')->references('id')->on('leave_requests')->onDelete('set null');
            $table-> date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_request_dates');
    }
};

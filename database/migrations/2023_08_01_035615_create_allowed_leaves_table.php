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
        Schema::create('allowed_leaves', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('position')->unsigned()->index()->nullable();
            $table->foreign('position')->references('id')->on('positions')->onDelete('set null');
            $table->bigInteger('type')->unsigned()->index()->nullable();
            $table->foreign('type')->references('id')->on('leave_types')->onDelete('set null');
            $table->integer('days');
            $table->string('term');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allowed_leaves');
    }
};

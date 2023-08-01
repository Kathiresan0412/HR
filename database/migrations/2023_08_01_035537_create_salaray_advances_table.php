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
        Schema::create('salaray_advances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bio_code')->unsigned()->index()->nullable();
            $table->foreign('bio_code')->references('id')->on('employees')->onDelete('set null');
            $table->decimal('amount');
            $table->string('type');
            $table->date('from_date');
            $table->date('to_date');
            $table->string('description');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaray_advances');
    }
};

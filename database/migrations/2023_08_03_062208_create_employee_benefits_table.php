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
        Schema::create('employee_benefits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('attendees')->unsigned()->index()->nullable();
            $table->foreign('attendees')->references('id')->on('employees')->onDelete('set null');
            $table->bigInteger('benefit_type')->unsigned()->index()->nullable();
            $table->foreign('benefit_type')->references('id')->on('employee_benefit_types')->onDelete('set null');
            $table->date('enrollment_date');
            $table->string('coverage_details');
            $table->decimal('premiums');
            $table->string('beneficiary_information');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_benefits');
    }
};

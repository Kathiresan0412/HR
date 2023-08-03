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
        Schema::create('recruitment_candidates', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('gender');
            $table->string('phone_no');
            $table->string('e_mail');
            $table->string('resume');
            $table->date('application_date');
            $table->bigInteger('position_id')->unsigned()->nullable();
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('set null');
            $table->string('interview_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruitment_candidates');
    }
};

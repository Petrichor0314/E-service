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
        Schema::create('attendance', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('subject_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->date('attendance_date')->nullable();
            $table->tinyInteger('attendance_type')->comment('1:present, 2:absent');
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};

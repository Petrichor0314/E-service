<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('marks', function (Blueprint $table) {
            $table->unique(['student_id', 'class_id', 'module_id', 'teacher_id','year'], 'unique_marks');
        });
    }

    public function down()
    {
        Schema::table('marks', function (Blueprint $table) {
            $table->dropUnique('unique_marks');
        });
    }
};

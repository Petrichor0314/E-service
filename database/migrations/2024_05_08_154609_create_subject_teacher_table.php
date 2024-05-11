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
        Schema::create('subject_teacher', function (Blueprint $table) {
            $table->bigIncrements('id');
/*             $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
 */         $table->integer('teacher_id');
            $table->integer('class_id');
            $table->integer('subject_id');

            // Define foreign key constraints explicitly
            /* $table->foreign('class_id')->references('id')->on('class')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subject')->onDelete('cascade'); */

            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_deleted')->default(0)->nullable();

            $table->integer('created_by')->nullable()->default(null);
            $table->dateTime('created_at')->nullable()->default(null);
            $table->dateTime('updated_at')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_teacher');
    }
};

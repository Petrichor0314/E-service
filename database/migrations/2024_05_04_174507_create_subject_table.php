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
        Schema::create('subject', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('type')->nullable();
            $table->integer('created_by')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0:active 
1:inactive');
            $table->tinyInteger('is_deleted')->default(0)->comment('0:no
1:yes');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject');
    }
};

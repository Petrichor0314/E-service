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
        Schema::create('class', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0:active 
1:inactive');
            $table->tinyInteger('is_deleted')->default(0)->comment('0:not deleted
1:deleted');
            $table->integer('created_by')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class');
    }
};

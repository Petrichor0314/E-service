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
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('filiere_id')->nullable(); 
            $table->tinyInteger('status')->default(0)->comment('0:active 1:inactive');
            $table->tinyInteger('is_deleted')->default(0)->comment('0:not deleted 1:deleted');
            $table->unsignedBigInteger('created_by')->nullable(); 
            $table->timestamps(); 

            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('filiere_id')->references('id')->on('filieres')->onDelete('set null');
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

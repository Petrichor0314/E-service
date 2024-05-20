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
        Schema::create('filieres', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('name');
            $table->unsignedBigInteger('coord')->nullable();
            $table->unsignedBigInteger('departements_id')->nullable();
            $table->timestamps();

            $table->foreign('coord')->references('id')->on('users')->onDelete('set null');
            $table->foreign('departements_id')->references('id')->on('departements')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filieres');
    }
};

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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('last_name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('user_type')->default(3)->comment('1:admin, 2:teacher,3;student
');
            $table->integer('is_deleted')->default(0)->comment('0:not deleted,
1:deleted');
$table->string('admission_number')->unique();
$table->string('roll_number')->unique();
$table->integer('class_id')->nullable();

$table->string('gender');
$table->date('date_of_birth');
$table->string('profil_pic')->nullable();
$table->date('admission_date');
$table->string('mobile_number')->unique();
$table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fname');
            $table->string('lname')->nullable();
            $table->string('tutor_id')->nullable();
            $table->string('class')->nullable();
            $table->string('email')->unique();
            $table->bigInteger('mobile')->nullable();
            $table->bigInteger('students_specify')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('otp')->nullable();
            $table->timestamp('otp_verified_at')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('password');
            $table->date('dob')->nullable();
            $table->string('role')->nullable();
            $table->string('location')->nullable();
            $table->string('city')->nullable();
            $table->integer('pincode')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

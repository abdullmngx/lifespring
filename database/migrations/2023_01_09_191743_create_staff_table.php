<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id')->unique();
            $table->string('name');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->date('dob')->nullable();
            $table->enum('religion', ['christianity', 'islam', 'others'])->nullable();
            $table->string('nationality')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();
            $table->string('passport')->nullable();
            $table->unsignedBigInteger('form_id')->nullable();
            $table->unsignedBigInteger('arm_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['super_admin', 'class_teacher', 'subject_teacher'])->default('subject_teacher');
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
        Schema::dropIfExists('staff');
    }
};

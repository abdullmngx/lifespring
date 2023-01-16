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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('admission_number')->nullable();
            //bio data
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('surname');
            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('religion', ['christianity', 'islam', 'others'])->nullable();
            $table->string('nationality')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();
            $table->string('passport')->nullable();
            //parent/guardian
            $table->string('parent_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('parent_occupation')->nullable();
            //Academic
            $table->unsignedBigInteger('form_joined')->nullable();
            $table->unsignedInteger('section_id')->nullable();
            $table->unsignedBigInteger('form_id')->nullable();
            $table->unsignedBigInteger('arm_id')->nullable();
            //auth
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('students');
    }
};

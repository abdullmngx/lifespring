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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('term_id');
            $table->unsignedBigInteger('form_id');
            $table->unsignedBigInteger('arm_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('subject_id');
            $table->float('ca1_score')->nullable();
            $table->float('ca2_score')->nullable();
            $table->float('ca3_score')->nullable();
            $table->float('ca4_score')->nullable();
            $table->float('exam_score')->nullable();
            $table->float('total_score')->nullable();
            $table->unsignedBigInteger('grade_id')->nullable();
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
        Schema::dropIfExists('results');
    }
};

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
        Schema::create('grade_remarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('form_id')->nullable();
            $table->unsignedBigInteger('grade_id');
            $table->string('remark');
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
        Schema::dropIfExists('grade_remarks');
    }
};

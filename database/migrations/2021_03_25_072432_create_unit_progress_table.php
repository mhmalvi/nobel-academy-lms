<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_progress', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();

            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('course_unit_id')->nullable();
            $table->foreign('course_unit_id')
                ->references('id')->on('course_units')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('current_step')->default(1);
            $table->integer('complete_step')->default(0);
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
        Schema::dropIfExists('unit_progress');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique()->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onDelete('set null')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('courses_teachers');
    }
}

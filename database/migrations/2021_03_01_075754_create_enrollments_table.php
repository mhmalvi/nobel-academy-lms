<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('action_user')->nullable();
            $table->foreign('action_user')
                    ->references('id')->on('users')
                    ->onDelete('set null');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id')
                    ->references('id')->on('students')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')
                    ->references('id')->on('teachers')
                    ->onDelete('set null');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')
                    ->references('id')->on('courses')
                    ->onDelete('cascade');
            $table->text('core_units')->nullable();
            $table->text('elective_units')->nullable();
            $table->enum('is_passed', ['y', 'n'])->default('n');
            $table->enum('is_suspended', ['y', 'n'])->default('n');
            $table->string('status')->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('enrollments');
    }
}

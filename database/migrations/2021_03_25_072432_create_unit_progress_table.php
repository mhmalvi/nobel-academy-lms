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

            $table->unsignedBigInteger('action_user')->nullable();
            $table->foreign('action_user')
                    ->references('id')->on('users')
                    ->onDelete('set null');
            
            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id')
                    ->references('id')->on('students')
                    ->onDelete('cascade');
            
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')
                    ->references('id')->on('courses')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('course_unit_id')->nullable();
            $table->foreign('course_unit_id')
                    ->references('id')->on('course_units')
                    ->onDelete('cascade');
            $table->text('steps')->nullable();
            $table->enum('step_one', ['0', '1'])->default('1');
            $table->enum('step_two', ['0', '1'])->default('0');
            $table->enum('step_three', ['0', '1'])->default('0');
            $table->enum('step_four', ['0', '1'])->default('0');
            $table->enum('step_five', ['0', '1'])->default('0');
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

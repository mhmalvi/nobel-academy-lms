<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssesmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesments', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique()->nullable();

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

            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')
                ->references('id')->on('course_units')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->text('links')->nullable();
            $table->dateTime('schedule')->nullable();
            $table->enum('status', ['pending', 'approved', 'reject'])->default('pending');
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
        Schema::dropIfExists('assesments');
    }
}

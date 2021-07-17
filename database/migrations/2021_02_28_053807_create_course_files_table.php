<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_files', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique()->nullable();

            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('file_name');
            $table->string('file_path')->nullable();
            $table->text('file_meta_data')->nullable();
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
        Schema::dropIfExists('course_files');
    }
}

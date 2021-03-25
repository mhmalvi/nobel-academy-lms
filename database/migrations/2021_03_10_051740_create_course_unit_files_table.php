<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseUnitFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_unit_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('action_user')->nullable();
            $table->foreign('action_user')
                    ->references('id')->on('users')
                    ->onDelete('set null');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')
                    ->references('id')->on('course_units')
                    ->onDelete('cascade');
            $table->string('file_name')->nullable();
            $table->text('file_path')->nullable();
            $table->text('file_ext')->nullable();
            $table->text('file_meta_data')->nullable();
            $table->enum('is_approved', ['y', 'n'])->default('n');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')
                    ->references('id')->on('users')
                    ->onDelete('set null');
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
        Schema::dropIfExists('course_unit_files');
    }
}

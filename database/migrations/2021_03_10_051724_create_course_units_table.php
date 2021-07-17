<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_units', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique()->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->enum('unit_type', ['core', 'elective'])->nullable();
            $table->string('unit_code')->unique()->nullable();
            $table->string('unit_name');
            $table->text('descriptions')->nullable();
            $table->integer('total_files')->default(0);
            $table->enum('is_published', ['y', 'n'])->default('n');
            $table->timestamps();
            $table->softDeletesTz($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_units');
    }
}

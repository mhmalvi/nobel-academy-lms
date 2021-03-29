<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique()->nullable();

            $table->unsignedBigInteger('action_user')->nullable();
            $table->foreign('action_user')
                    ->references('id')->on('users')
                    ->onDelete('set null')
                    ->onUpdate('cascade');

            $table->string('course_code')->nullable();
            $table->string('course_name');

            $table->unsignedBigInteger('course_category_id')->nullable();
            $table->foreign('course_category_id')
                    ->references('id')->on('course_categories')
                    ->onDelete('set null')
                    ->onUpdate('cascade');
            
            $table->integer('course_units')->nullable();
            $table->text('descriptions')->nullable();
            $table->enum('is_published', ['y', 'n'])->default('n');
            $table->integer('total_enrolled')->default(0);
            $table->integer('total_teachers')->default(0);
            $table->integer('total_files')->default(0);
            $table->string('course_thumbnail')->nullable();
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
        Schema::dropIfExists('courses');
    }
}

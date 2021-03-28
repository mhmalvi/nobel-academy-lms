<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique()->nullable();
            $table->unsignedBigInteger('action_user')->nullable();
            $table->foreign('action_user')
                    ->references('id')->on('users')
                    ->onDelete('set null');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')
                    ->references('id')->on('roles')
                    ->onDelete('set null');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->enum('user_type', ['teacher', 'student', 'staff', 'guest'])->default('guest');
            $table->enum('is_admin', ['0','1'])->default('0');
            $table->enum('multi_course', ['yes', 'no'])->default('no');
            $table->enum('is_suspended', ['yes', 'no'])->default('no');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

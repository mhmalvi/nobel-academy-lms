<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique()->nullable();

            $table->string('subject');
            $table->longText('text');
            $table->enum('is_approved', ['y', 'n'])->default('n');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')
                ->references('id')->on('users')
                ->onDelete('set null');
            $table->string('thumbnail')->nullable();
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
        Schema::dropIfExists('announcements');
    }
}

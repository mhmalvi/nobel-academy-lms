<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_files', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique()->nullable();

            $table->unsignedBigInteger('announcement_id')->nullable();
            $table->foreign('announcement_id')
                    ->references('id')->on('announcements')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            
            $table->string('file_name')->nullable();
            $table->text('file_path')->nullable();
            $table->text('file_ext')->nullable();
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
        Schema::dropIfExists('announcement_files');
    }
}

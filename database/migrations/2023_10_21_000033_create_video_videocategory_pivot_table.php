<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoVideocategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('video_videocategory', function (Blueprint $table) {
            $table->unsignedBigInteger('video_id');
            $table->foreign('video_id', 'video_id_fk_9058633')->references('id')->on('videos')->onDelete('cascade');
            $table->unsignedBigInteger('videocategory_id');
            $table->foreign('videocategory_id', 'videocategory_id_fk_9058633')->references('id')->on('videocategories')->onDelete('cascade');
        });
    }
}

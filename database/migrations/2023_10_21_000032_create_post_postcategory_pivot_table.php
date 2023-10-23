<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostPostcategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('post_postcategory', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id', 'post_id_fk_9058632')->references('id')->on('posts')->onDelete('cascade');
            $table->unsignedBigInteger('postcategory_id');
            $table->foreign('postcategory_id', 'postcategory_id_fk_9058632')->references('id')->on('postcategories')->onDelete('cascade');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignsTable extends Migration
{
    public function up()
    {
        Schema::create('designs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('statues')->nullable();
            $table->string('confirmation')->nullable();
            $table->string('note')->nullable();
            $table->string('review')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

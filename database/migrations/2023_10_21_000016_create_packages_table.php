<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('ads')->nullable();
            $table->string('post')->nullable();
            $table->string('design')->nullable();
            $table->string('video')->nullable();
            $table->string('platforms')->nullable();
            $table->string('story')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

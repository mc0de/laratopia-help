<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('statues')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

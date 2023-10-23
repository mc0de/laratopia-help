<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageProjectPivotTable extends Migration
{
    public function up()
    {
        Schema::create('package_project', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id', 'project_id_fk_9058646')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id', 'package_id_fk_9058646')->references('id')->on('packages')->onDelete('cascade');
        });
    }
}

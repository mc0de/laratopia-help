<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdAdcategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('ad_adcategory', function (Blueprint $table) {
            $table->unsignedBigInteger('ad_id');
            $table->foreign('ad_id', 'ad_id_fk_9058634')->references('id')->on('ads')->onDelete('cascade');
            $table->unsignedBigInteger('adcategory_id');
            $table->foreign('adcategory_id', 'adcategory_id_fk_9058634')->references('id')->on('adcategories')->onDelete('cascade');
        });
    }
}

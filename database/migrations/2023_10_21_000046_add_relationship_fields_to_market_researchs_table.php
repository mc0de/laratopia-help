<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMarketResearchsTable extends Migration
{
    public function up()
    {
        Schema::table('market_researchs', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9106083')->references('id')->on('teams');
        });
    }
}

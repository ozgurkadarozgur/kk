<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeagueFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_fixtures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('league_id');
            $table->tinyInteger('week_number');
            $table->unsignedInteger('team1_id');
            $table->unsignedInteger('team2_id');
            $table->unsignedInteger('astroturf_id')->nullable();
            $table->tinyInteger('team1_score')->nullable();
            $table->tinyInteger('team2_score')->nullable();
            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->timestamps();

            $table->foreign('league_id')
                ->references('id')
                ->on('leagues')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('league_fixtures');
    }
}

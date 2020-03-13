<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEliminationMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elimination_matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('elimination_id');
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('team1_id');
            $table->unsignedBigInteger('team2_id');
            $table->unsignedTinyInteger('team1_score')->nullable();
            $table->unsignedTinyInteger('team2_score')->nullable();
            $table->unsignedBigInteger('astroturf_id')->nullable();
            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->timestamps();

            $table->foreign('elimination_id')
                ->references('id')
                ->on('eliminations')
                ->onDelete('cascade');

            $table->foreign('level_id')
                ->references('id')
                ->on('elimination_levels')
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
        Schema::dropIfExists('elimination_matches');
    }
}

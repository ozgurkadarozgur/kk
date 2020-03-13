<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inviter_id');
            $table->unsignedBigInteger('inviter_team_id');
            $table->unsignedBigInteger('invited_id');
            $table->unsignedBigInteger('invited_team_id');
            $table->unsignedBigInteger('astroturf_id');
            $table->unsignedTinyInteger('status_code');
            $table->decimal('cost', 13,2)->default(0.00);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();

            $table->foreign('inviter_id')
                ->references('id')
                ->on('players')
                ->onDelete('no action');

            $table->foreign('inviter_team_id')
                ->references('id')
                ->on('teams')
                ->onDelete('no action');

            $table->foreign('invited_id')
                ->references('id')
                ->on('players')
                ->onDelete('no action');

            $table->foreign('invited_team_id')
                ->references('id')
                ->on('teams')
                ->onDelete('no action');

            $table->foreign('astroturf_id')
                ->references('id')
                ->on('astroturfs')
                ->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vs');
    }
}

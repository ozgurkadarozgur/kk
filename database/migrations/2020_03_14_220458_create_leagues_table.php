<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('facility_id');
            $table->string('title');
            $table->text('image_url')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->tinyInteger('week_count');
            $table->tinyInteger('max_team_count');
            $table->tinyInteger('min_player_count');
            $table->decimal('cost', 13,2)->default(0.00);
            $table->json('awards');
            $table->boolean('is_started')->default(false);
            $table->boolean('is_open')->default(true);
            $table->timestamps();

            $table->foreign('facility_id')
                ->references('id')
                ->on('facilities')
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
        Schema::dropIfExists('leagues');
    }
}

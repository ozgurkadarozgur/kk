<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAstroturfCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('astroturf_calendar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('astroturf_id');
            $table->string('title');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('is_subscriber')->default(false);
            $table->timestamps();

            $table->foreign('astroturf_id')
                ->references('id')
                ->on('astroturfs')
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
        Schema::dropIfExists('astroturf_calendar');
    }
}

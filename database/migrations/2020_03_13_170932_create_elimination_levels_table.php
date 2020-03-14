<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEliminationLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elimination_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('elimination_id');
            $table->string('title');
            $table->boolean('is_over')->default(false);
            $table->timestamps();

            $table->foreign('elimination_id')
                ->references('id')
                ->on('eliminations')
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
        Schema::dropIfExists('elimination_levels');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('geoguessr_game_token');
            $table->integer('round');
            $table->string('nickname');

            $table->string('panoid'); // The current pano ID for this position
            $table->string('position'); //
            $table->string('pov');
            $table->integer('previous_position_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movements');
    }
}

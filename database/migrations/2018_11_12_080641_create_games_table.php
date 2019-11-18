<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string( 'title');
            $table->text('description');
            $table->integer('publisher_id');
            $table->string('players')->nullable();
            $table->string('time')->nullable();
            $table->string('age')->nullable();
            $table->string('ads')->nullable();
            $table->boolean('addition')->dafault(0);
            $table->integer('game_id')->nullable();
            $table->string('cover');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}

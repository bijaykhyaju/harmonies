<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('music_id')->unsigned();
            $table->string('note_name');
            $table->bigInteger('column_id');
            $table->bigInteger('instrument_id')->unsigned();
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
        Schema::dropIfExists('music_notes');
    }
}

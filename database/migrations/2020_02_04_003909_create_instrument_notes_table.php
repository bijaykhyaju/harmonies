<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrument_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('index');
            $table->text('file_full_path')->nullable();
            $table->string('description')->nullable();
            $table->integer('instrument_id')->unsigned();
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
        Schema::dropIfExists('instrument_notes');
    }
}

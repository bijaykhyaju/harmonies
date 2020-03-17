<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstrumentNote extends Model
{
    //

    public static function getInstrumentNotes($id){

      return InstrumentNote::where("instrument_id",$id)->orderBy('index')->get();

    }
}


//Tinker adding Data
//'a0','a1','a2','a3','a4','a5','a6'
//for Piano
// $notes = new App\InstrumentNote;
// $notes->name = "a0";
// $notes->index = "1";
// $notes->instrument_id = "1";
// $notes->save();
//
// $notes = new App\InstrumentNote;
// $notes->name = "a1";
// $notes->index = "2";
// $notes->instrument_id = "1";
// $notes->save();
//
// $notes = new App\InstrumentNote;
// $notes->name = "a2";
// $notes->index = "3";
// $notes->instrument_id = "1";
// $notes->save();
//
// $notes = new App\InstrumentNote;
// $notes->name = "a3";
// $notes->index = "4";
// $notes->instrument_id = "1";
// $notes->save();
//
// $notes = new App\InstrumentNote;
// $notes->name = "a4";
// $notes->index = "5";
// $notes->instrument_id = "1";
// $notes->save();
//
// $notes = new App\InstrumentNote;
// $notes->name = "a5";
// $notes->index = "6";
// $notes->instrument_id = "1";
// $notes->save();
//
// $notes = new App\InstrumentNote;
// $notes->name = "a6";
// $notes->index = "7";
// $notes->instrument_id = "1";
// $notes->save();


//for Flute
//'a','b','c','d2','e','f','g'
// $notes = new App\InstrumentNote;
// $notes->name = "a";
// $notes->index = "1";
// $notes->instrument_id = "2";
// $notes->save();
//
// $notes = new App\InstrumentNote;
// $notes->name = "b";
// $notes->index = "2";
// $notes->instrument_id = "2";
// $notes->save();
//
// $notes = new App\InstrumentNote;
// $notes->name = "c";
// $notes->index = "3";
// $notes->instrument_id = "2";
// $notes->save();
//
// $notes = new App\InstrumentNote;
// $notes->name = "d2";
// $notes->index = "4";
// $notes->instrument_id = "2";
// $notes->save();
//
// $notes = new App\InstrumentNote;
// $notes->name = "e";
// $notes->index = "5";
// $notes->instrument_id = "2";
// $notes->save();
//
// $notes = new App\InstrumentNote;
// $notes->name = "f";
// $notes->index = "6";
// $notes->instrument_id = "2";
// $notes->save();
//
// $notes = new App\InstrumentNote;
// $notes->name = "g";
// $notes->index = "7";
// $notes->instrument_id = "2";
// $notes->save();

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstrumentCollection extends Model
{
    //
    public static function getAllMusicInstruments(){

      return InstrumentCollection::where('publish','1')
                                    ->where('parent_id','0')
                                    ->get();

    }

    public static function getAllNotesOfInstrument($instrument_id){

      return InstrumentCollection::where('publish','1')
                                    ->where('parent_id',$instrument_id)
                                    ->get();

    }

    public static function getInstrumentById($id){
      return InstrumentCollection::where('publish','1')
                                    ->where('id',$id)
                                    ->first();
    }
    public static function getParentInstrumentById($parent_id){
      return InstrumentCollection::where('publish','1')
                                    ->where('id',$parent_id)
                                    ->first();
    }

    




}

//add data in instrument_collections table using Tinker

//Adding Music instruments
// $instrument = new App\InstrumentCollection;
// $instrument->name = "Guitar";
// $instrument->parent_id = "0";
// $instrument->file_path = "tonejs/audio/guitar/";
// $instrument->publish = "1";
// $instrument->order = "1";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "Piano";
// $instrument->parent_id = "0";
// $instrument->file_path = "tonejs/audio/piano/";
// $instrument->publish = "1";
// $instrument->order = "1";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "Flute";
// $instrument->parent_id = "0";
// $instrument->file_path = "tonejs/audio/flute/";
// $instrument->publish = "1";
// $instrument->order = "1";
// $instrument->save();


//Adding notes to the respective $instruments
//for piano
// $instrument = new App\InstrumentCollection;
// $instrument->name = "A0";
// $instrument->parent_id = "2";
// $instrument->file_name = "A0.mp3";
// $instrument->publish = "1";
// $instrument->order = "1";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "A1";
// $instrument->parent_id = "2";
// $instrument->file_name = "A1.mp3";
// $instrument->publish = "1";
// $instrument->order = "2";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "A2";
// $instrument->parent_id = "2";
// $instrument->file_name = "A2.mp3";
// $instrument->publish = "1";
// $instrument->order = "3";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "A3";
// $instrument->parent_id = "2";
// $instrument->file_name = "A3.mp3";
// $instrument->publish = "1";
// $instrument->order = "4";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "A4";
// $instrument->parent_id = "2";
// $instrument->file_name = "A4.mp3";
// $instrument->publish = "1";
// $instrument->order = "5";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "A5";
// $instrument->parent_id = "2";
// $instrument->file_name = "A5.mp3";
// $instrument->publish = "1";
// $instrument->order = "6";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "A6";
// $instrument->parent_id = "2";
// $instrument->file_name = "A6.mp3";
// $instrument->publish = "1";
// $instrument->order = "7";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "A7";
// $instrument->parent_id = "2";
// $instrument->file_name = "A7.mp3";
// $instrument->publish = "1";
// $instrument->order = "8";
// $instrument->save();

// $instrument = new App\InstrumentCollection;
// $instrument->name = "C1";
// $instrument->parent_id = "2";
// $instrument->file_name = "C1.mp3";
// $instrument->publish = "1";
// $instrument->order = "9";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "C2";
// $instrument->parent_id = "2";
// $instrument->file_name = "C2.mp3";
// $instrument->publish = "1";
// $instrument->order = "10";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "C3";
// $instrument->parent_id = "2";
// $instrument->file_name = "C3.mp3";
// $instrument->publish = "1";
// $instrument->order = "11";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "C4";
// $instrument->parent_id = "2";
// $instrument->file_name = "C4.mp3";
// $instrument->publish = "1";
// $instrument->order = "12";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "C5";
// $instrument->parent_id = "2";
// $instrument->file_name = "C5.mp3";
// $instrument->publish = "1";
// $instrument->order = "13";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "C6";
// $instrument->parent_id = "2";
// $instrument->file_name = "C6.mp3";
// $instrument->publish = "1";
// $instrument->order = "14";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "C7";
// $instrument->parent_id = "2";
// $instrument->file_name = "C7.mp3";
// $instrument->publish = "1";
// $instrument->order = "15";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "C8";
// $instrument->parent_id = "2";
// $instrument->file_name = "C8.mp3";
// $instrument->publish = "1";
// $instrument->order = "16";
// $instrument->save();

// $instrument = new App\InstrumentCollection;
// $instrument->name = "Ds1";
// $instrument->parent_id = "2";
// $instrument->file_name = "Ds1.mp3";
// $instrument->publish = "1";
// $instrument->order = "17";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "Ds2";
// $instrument->parent_id = "2";
// $instrument->file_name = "Ds2.mp3";
// $instrument->publish = "1";
// $instrument->order = "18";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "Ds3";
// $instrument->parent_id = "2";
// $instrument->file_name = "Ds3.mp3";
// $instrument->publish = "1";
// $instrument->order = "19";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "Ds4";
// $instrument->parent_id = "2";
// $instrument->file_name = "Ds4.mp3";
// $instrument->publish = "1";
// $instrument->order = "20";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "Ds5";
// $instrument->parent_id = "2";
// $instrument->file_name = "Ds5.mp3";
// $instrument->publish = "1";
// $instrument->order = "21";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "Ds6";
// $instrument->parent_id = "2";
// $instrument->file_name = "Ds6.mp3";
// $instrument->publish = "1";
// $instrument->order = "22";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "Ds7";
// $instrument->parent_id = "2";
// $instrument->file_name = "Ds7.mp3";
// $instrument->publish = "1";
// $instrument->order = "23";
// $instrument->save();

// $instrument = new App\InstrumentCollection;
// $instrument->name = "Fs1";
// $instrument->parent_id = "2";
// $instrument->file_name = "Fs1.mp3";
// $instrument->publish = "1";
// $instrument->order = "24";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "Fs2";
// $instrument->parent_id = "2";
// $instrument->file_name = "Fs2.mp3";
// $instrument->publish = "1";
// $instrument->order = "25";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "Fs3";
// $instrument->parent_id = "2";
// $instrument->file_name = "Fs3.mp3";
// $instrument->publish = "1";
// $instrument->order = "26";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "Fs4";
// $instrument->parent_id = "2";
// $instrument->file_name = "Fs4.mp3";
// $instrument->publish = "1";
// $instrument->order = "27";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "Fs5";
// $instrument->parent_id = "2";
// $instrument->file_name = "Fs5.mp3";
// $instrument->publish = "1";
// $instrument->order = "28";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "Fs6";
// $instrument->parent_id = "2";
// $instrument->file_name = "Fs6.mp3";
// $instrument->publish = "1";
// $instrument->order = "29";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "Fs7";
// $instrument->parent_id = "2";
// $instrument->file_name = "Fs7.mp3";
// $instrument->publish = "1";
// $instrument->order = "30";
// $instrument->save();

//Adding notes for Flute

// $instrument = new App\InstrumentCollection;
// $instrument->name = "a";
// $instrument->parent_id = "3";
// $instrument->file_name = "a.wav";
// $instrument->publish = "1";
// $instrument->order = "1";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "b";
// $instrument->parent_id = "3";
// $instrument->file_name = "b.wav";
// $instrument->publish = "1";
// $instrument->order = "2";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "c";
// $instrument->parent_id = "3";
// $instrument->file_name = "c.wav";
// $instrument->publish = "1";
// $instrument->order = "3";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "d";
// $instrument->parent_id = "3";
// $instrument->file_name = "d.wav";
// $instrument->publish = "1";
// $instrument->order = "4";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "e";
// $instrument->parent_id = "3";
// $instrument->file_name = "e.wav";
// $instrument->publish = "1";
// $instrument->order = "5";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "f";
// $instrument->parent_id = "3";
// $instrument->file_name = "f.wav";
// $instrument->publish = "1";
// $instrument->order = "6";
// $instrument->save();
//
// $instrument = new App\InstrumentCollection;
// $instrument->name = "g";
// $instrument->parent_id = "3";
// $instrument->file_name = "g.wav";
// $instrument->publish = "1";
// $instrument->order = "7";
// $instrument->save();

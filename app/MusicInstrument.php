<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class MusicInstrument extends Model
{
    //
    public static function getInstrument($id){

      return MusicInstrument::findOrFail($id);

    }

    public static function getLatestInstrument(){

      return MusicInstrument::where('publish','1')
                              ->where('user_id',Auth::user()->id)
                              ->orWhere('default','1')
                              ->latest()->first();

    }

    public static function getAllInstruments(){
      return MusicInstrument:: where('publish','1')
                              ->where('user_id',Auth::user()->id)
                              ->orWhere('default','1')
                              ->latest()->get();

    }

    public static function isInstrumentPublish($id){
      $isPublish = MusicInstrument::where('publish','1')
                                    ->where('id',$id)
                                    ->count();
      return $isPublish>0 ? 'checked' : '';
    }







}


//Tinker adding Data

// $notes = new App\MusicInstrument;
// $notes->name = "Piano";
// $notes->user_id = "0";
// $notes->default = "1";
// $notes->publish = "1";
// $notes->save();
//
// $notes = new App\MusicInstrument;
// $notes->name = "Flute";
// $notes->user_id = "0";
// $notes->default = "1";
// $notes->publish = "1";
// $notes->save();

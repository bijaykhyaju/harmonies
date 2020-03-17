<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MusicNote extends Model
{
    //
    /**
       * The database table used by the model.
       *
       * @var string
       */
      protected $table = 'music_notes';


      public static function getHigestColumnNumber($musicId){
        return MusicNote::where('music_id',$musicId)
                          ->max('column_id');

      }







}

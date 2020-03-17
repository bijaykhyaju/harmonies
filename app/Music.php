<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    //

    public static function isMusicNoteSelected($musicId, $note, $column){

      $isSelected = MusicNote::where('music_id', $musicId)
                     ->where('note_name', $note)
                     ->where('column_id', $column)
                     ->first();
      return $isSelected;

    }
}
